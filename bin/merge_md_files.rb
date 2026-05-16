require 'fileutils'
require 'pathname'
require 'yaml'

SKIP_GENERATED_FILES = %w[1page.md onepage.md ai-assistant.md].freeze
SKIP_NAV_PAGES = %w[1page ai-assistant].freeze

def convert_to_markdown_filename(base_name)
  base_name.split(/[_-]/).map(&:capitalize).join + '.md'
end

def build_permalink_index(source)
  source.glob('**/*.md').each_with_object({}) do |path, index|
    next if SKIP_GENERATED_FILES.include?(path.basename.to_s)

    frontmatter = path.read[/\A---\s*\r?\n(.*?)\r?\n---\s*\r?\n/m, 1]
    next unless frontmatter

    data = YAML.safe_load(frontmatter, aliases: true) || {}
    permalink = data['permalink']
    next unless permalink

    index[permalink] = path.relative_path_from(source).to_s
  rescue Psych::Exception
    next
  end
end

def resolve_markdown_filename(base_name, source, permalink_index, expected_permalink = nil)
  candidates = [
    "#{base_name}.md",
    "#{base_name.tr('_', '.')}.md",
    convert_to_markdown_filename(base_name)
  ].uniq

  matched_candidate = candidates.find { |candidate| source.join(candidate).file? }
  return matched_candidate if matched_candidate

  return nil unless expected_permalink

  permalink_index[expected_permalink]
end

def extract_order_from_contents(language, source)
  contents_file = Pathname.new(__dir__).join('..', '_includes/manuals/1.0', language, 'contents.html')
  unless contents_file.file?
    puts "Warning: Contents file not found: #{contents_file}"
    return nil
  end

  contents = contents_file.read
  permalinks = contents.scan(%r{href="/manuals/1\.0/#{language}/([^"]+\.html)"}).flatten

  if permalinks.empty?
    puts "Warning: No permalinks found in #{contents_file}. Navigation structure may have changed."
    return nil
  end

  puts "Found #{permalinks.length} pages in navigation order"
  permalink_index = build_permalink_index(source)

  permalinks.filter_map do |permalink|
    base = permalink.sub('.html', '')
    next if SKIP_NAV_PAGES.include?(base)

    filename = resolve_markdown_filename(base, source, permalink_index, "/manuals/1.0/#{language}/#{permalink}")
    unless filename
      puts "Warning: Markdown file not found for #{permalink}"
      next
    end

    filename
  end
end

def strip_frontmatter(content)
  content.sub(/\A---\s*\r?\n.*?\r?\n---\s*\r?\n/m, '')
end

def normalize_generated_markdown(content)
  inside_fence = false
  fence_marker = nil

  content.each_line.map do |line|
    stripped = line.strip

    if stripped.start_with?('```', '~~~')
      marker = stripped[0, 3]
      if inside_fence && stripped == fence_marker
        inside_fence = false
        fence_marker = nil
        line
      elsif !inside_fence
        inside_fence = true
        fence_marker = marker
        stripped == marker ? line.sub(marker, "#{marker}text") : line
      else
        line
      end
    elsif !inside_fence && stripped == '---'
      line.sub('---', '***')
    else
      line
    end
  end.join
end

def fallback_order(source)
  source.glob('*.md')
        .map(&:basename)
        .map(&:to_s)
        .reject { |file| SKIP_GENERATED_FILES.include?(file) }
        .sort
end

def generate_combined_file(language, intro_message)
  source = Pathname.new(__dir__).join('..', 'manuals/1.0', language)
  output_file = source.join('1page.md')
  legacy_output_file = source.join('onepage.md')

  puts "Processing #{language} documentation..."
  raise 'Source folder does not exist!' unless source.directory?

  if legacy_output_file.exist?
    FileUtils.rm_f(legacy_output_file)
    puts "Removed legacy file: #{legacy_output_file}"
  end

  file_order = extract_order_from_contents(language, source)
  if file_order.nil? || file_order.empty?
    puts 'Warning: Could not extract order from contents.html, using alphabetical order'
    file_order = fallback_order(source)
  end

  all_files = file_order.map { |filename| source.join(filename) }.select(&:file?)
  files_processed = 0

  File.open(output_file, 'w') do |out|
    out.write <<~HEADER
      ---
      layout: docs-#{language}
      title: ALPS/ASD Complete Manual
      category: Manual
      permalink: /manuals/1.0/#{language}/1page.html
      ---

      # ALPS/ASD Complete Manual

      #{intro_message}

      ***
    HEADER

    all_files.each_with_index do |path, index|
      content = normalize_generated_markdown(strip_frontmatter(path.read)).strip
      next if content.empty?

      out.write("\n***\n\n") if index.positive?
      out.write(content.lines.map(&:rstrip).join("\n") + "\n")
      puts "  Added: #{path.relative_path_from(source)}"
      files_processed += 1
    rescue StandardError => e
      puts "  Error processing #{path.relative_path_from(source)}: #{e.message}"
    end
  end

  puts "Generated: #{output_file}"
  puts "Total sections: #{files_processed}"
end

generate_combined_file('en', 'This comprehensive manual contains the main ALPS/ASD documentation in a single page for easy reference, printing, or offline viewing.')
generate_combined_file('ja', 'このページは、ALPS/ASDの主要ドキュメントを1ページにまとめた包括的なマニュアルです。参照、印刷、オフライン閲覧に便利です。')
