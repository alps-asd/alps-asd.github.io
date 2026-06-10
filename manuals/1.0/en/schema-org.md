---
layout: docs-en
title: Schema.org Terms
category: Manual
sidebar: false
permalink: /manuals/1.0/en/schema-org.html
---

<link rel="stylesheet" href="{{ '/css/schema-styles.css' | relative_url }}">
<script src="{{ '/js/schema-xref.js' | relative_url }}" defer></script>


# Schema.org Terms

<h2>Properties</h2>

{% include html/schema-search.html table_id="schema-property-table" %}

<table id="schema-property-table">
  <thead>
    <tr>
      <th>Property</th>
      <th>Description</th>
      <th>Meta information</th>
    </tr>
  </thead>
  <tbody>
    {% for property in site.data.schema_properties %}
      <tr id="schema-property-{{ property.label }}"
          data-schema-term="{{ property.label | escape }}"
          data-schema-kind="property"
          data-domain-includes="{{ property.domainIncludes | replace: 'https://schema.org/', '' | escape }}"
          data-range-includes="{{ property.rangeIncludes | replace: 'https://schema.org/', '' | escape }}"
          data-sub-property-of="{{ property.subPropertyOf | replace: 'https://schema.org/', '' | escape }}"
          data-inverse-of="{{ property.inverseOf | replace: 'https://schema.org/', '' | escape }}">
        <td>
          <a href="https://schema.org/{{ property.label }}" class="schema-link">{{ property.label }}</a>
        </td>
        <td>{{ property.comment | replace: 'href="/', 'href="https://schema.org/' }}</td>
        {% include html/property-meta.html property=property %}
      </tr>
    {% endfor %}
  </tbody>
</table>

<h2>Types</h2>

<table id="schema-type-table">
  <thead>
    <tr>
      <th>Type</th>
      <th>Description</th>
      <th>Meta information</th>
    </tr>
  </thead>
  <tbody>
    {% for type in site.data.schema_types %}
      <tr id="schema-type-{{ type.label }}"
          data-schema-term="{{ type.label | escape }}"
          data-schema-kind="type"
          data-sub-type-of="{{ type.subTypeOf | replace: 'https://schema.org/', '' | escape }}"
          data-properties="{{ type.properties | replace: 'https://schema.org/', '' | escape }}">
        <td>
          <a href="https://schema.org/{{ type.label }}" class="schema-link">{{ type.label }}</a>
        </td>
        <td>{{ type.comment | replace: 'href="/', 'href="https://schema.org/' }}</td>
        {% include html/type-meta.html type=type %}
      </tr>
    {% endfor %}
  </tbody>
</table>
