---
layout: docs-en
title: Schema.org Terms
category: Manual
permalink: /manuals/1.0/en/schema-org.html
---

<link rel="stylesheet" href="{{ '/css/schema-styles.css' | relative_url }}">


# Schema.org プロパティ一覧

{% include html/schema-search.html table_id="schema-property-table" %}

<table id="schema-property-table">
  <thead>
    <tr>
      <th>プロパティ</th>
      <th>説明</th>
      <th>メタ情報</th>
    </tr>
  </thead>
  <tbody>
    {% for property in site.data.schema_properties %}
      <tr>
        <td>
          <a href="https://schema.org/{{ property.label }}" class="schema-link">{{ property.label }}</a>
        </td>
        <td>{{ property.comment }}</td>
        {% include html/property-meta.html property=property %}
      </tr>
    {% endfor %}
  </tbody>
</table>

<h1 id="types">Schema.org タイプ一覧</h1>

{% include html/schema-search.html table_id="schema-type-table" %}

<table id="schema-type-table">
  <thead>
    <tr>
      <th>タイプ</th>
      <th>説明</th>
      <th>メタ情報</th>
    </tr>
  </thead>
  <tbody>
    {% for type in site.data.schema_types %}
      <tr>
        <td>
          <a href="https://schema.org/{{ type.label }}" class="schema-link">{{ type.label }}</a>
        </td>
        <td>{{ type.comment }}</td>
        {% include html/type-meta.html type=type %}
      </tr>
    {% endfor %}
  </tbody>
</table>