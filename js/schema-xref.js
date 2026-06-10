(function () {
    'use strict';

    const I18N = {
        en: {
            usedBy: 'Used by',
            references: 'references',
            relationLabels: {
                typeProperty: 'Types using this property',
                domain: 'Properties with this domain',
                range: 'Properties with this range',
                subPropertyOf: 'Subproperties',
                inverseOf: 'Inverse properties',
                subTypeOf: 'Subtypes'
            }
        },
        ja: {
            usedBy: '参照元',
            references: '件を表示',
            relationLabels: {
                typeProperty: 'このプロパティを使うタイプ',
                domain: 'Domainに指定しているプロパティ',
                range: 'Rangeに指定しているプロパティ',
                subPropertyOf: 'サブプロパティ',
                inverseOf: 'InverseOfで参照するプロパティ',
                subTypeOf: 'サブタイプ'
            }
        }
    };

    const RELATION_ORDER = [
        'typeProperty',
        'domain',
        'range',
        'subPropertyOf',
        'inverseOf',
        'subTypeOf'
    ];

    function onReady(callback) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback);
            return;
        }

        callback();
    }

    function parseList(value) {
        if (!value) {
            return [];
        }

        return value
            .split(',')
            .map((item) => item.trim().replace(/^https?:\/\/schema\.org\//, ''))
            .filter(Boolean);
    }

    function keyFor(kind, term) {
        return `${kind}:${term}`;
    }

    function anchorFor(kind, term) {
        return `#schema-${kind}-${term}`;
    }

    function addReference(references, rowIndex, targetKind, targetTerm, sourceKind, sourceTerm, relation) {
        if (!targetTerm || targetTerm.includes('://')) {
            return;
        }

        const targetKey = keyFor(targetKind, targetTerm);
        const sourceKey = keyFor(sourceKind, sourceTerm);

        if (!rowIndex.has(targetKey) || !rowIndex.has(sourceKey)) {
            return;
        }

        const refs = references.get(targetKey) || [];
        const exists = refs.some((ref) => (
            ref.sourceKind === sourceKind &&
            ref.sourceTerm === sourceTerm &&
            ref.relation === relation
        ));

        if (!exists) {
            refs.push({ sourceKind, sourceTerm, relation });
            references.set(targetKey, refs);
        }
    }

    function buildReferences(rows, rowIndex) {
        const references = new Map();

        rows.forEach((row) => {
            const sourceKind = row.dataset.schemaKind;
            const sourceTerm = row.dataset.schemaTerm;

            if (sourceKind === 'property') {
                parseList(row.dataset.domainIncludes).forEach((term) => {
                    addReference(references, rowIndex, 'type', term, sourceKind, sourceTerm, 'domain');
                });

                parseList(row.dataset.rangeIncludes).forEach((term) => {
                    addReference(references, rowIndex, 'type', term, sourceKind, sourceTerm, 'range');
                });

                parseList(row.dataset.subPropertyOf).forEach((term) => {
                    addReference(references, rowIndex, 'property', term, sourceKind, sourceTerm, 'subPropertyOf');
                });

                parseList(row.dataset.inverseOf).forEach((term) => {
                    addReference(references, rowIndex, 'property', term, sourceKind, sourceTerm, 'inverseOf');
                });
            }

            if (sourceKind === 'type') {
                parseList(row.dataset.subTypeOf).forEach((term) => {
                    addReference(references, rowIndex, 'type', term, sourceKind, sourceTerm, 'subTypeOf');
                });

                parseList(row.dataset.properties).forEach((term) => {
                    addReference(references, rowIndex, 'property', term, sourceKind, sourceTerm, 'typeProperty');
                });
            }
        });

        return references;
    }

    function groupByRelation(refs) {
        return refs.reduce((groups, ref) => {
            if (!groups.has(ref.relation)) {
                groups.set(ref.relation, []);
            }

            groups.get(ref.relation).push(ref);
            return groups;
        }, new Map());
    }

    function createSourceLink(ref) {
        const link = document.createElement('a');
        link.href = anchorFor(ref.sourceKind, ref.sourceTerm);
        link.className = `meta-tag schema-xref-source schema-xref-${ref.sourceKind}-tag`;
        link.textContent = ref.sourceTerm;
        return link;
    }

    function renderReferenceList(content, refs, labels) {
        const groups = groupByRelation(refs);

        RELATION_ORDER.forEach((relation) => {
            const groupRefs = groups.get(relation);
            if (!groupRefs || groupRefs.length === 0) {
                return;
            }

            const group = document.createElement('div');
            group.className = 'schema-xref-group';

            const label = document.createElement('div');
            label.className = 'schema-xref-group-label';
            label.textContent = `${labels.relationLabels[relation]} (${groupRefs.length})`;
            group.appendChild(label);

            const values = document.createElement('div');
            values.className = 'schema-xref-values';

            groupRefs
                .slice()
                .sort((a, b) => a.sourceTerm.localeCompare(b.sourceTerm))
                .forEach((ref) => values.appendChild(createSourceLink(ref)));

            group.appendChild(values);
            content.appendChild(group);
        });
    }

    function installReferenceDetails(row, refs, labels) {
        const container = row.querySelector('.schema-xref-container');
        if (!container || refs.length === 0) {
            return;
        }

        container.hidden = false;

        const label = document.createElement('span');
        label.className = 'meta-label';
        label.textContent = `${labels.usedBy}:`;

        const values = document.createElement('div');
        values.className = 'meta-values';

        const details = document.createElement('details');
        details.className = 'schema-xref-details';

        const summary = document.createElement('summary');
        summary.innerHTML = `<span class="schema-xref-count">${refs.length}</span> ${labels.references}`;
        details.appendChild(summary);

        const content = document.createElement('div');
        content.className = 'schema-xref-content';
        details.appendChild(content);

        details.addEventListener('toggle', () => {
            if (!details.open || details.dataset.rendered === 'true') {
                return;
            }

            renderReferenceList(content, refs, labels);
            details.dataset.rendered = 'true';
        });

        values.appendChild(details);
        container.appendChild(label);
        container.appendChild(values);
    }

    function flashLinkedRow(event) {
        const link = event.target.closest('.schema-xref-link, .schema-xref-source');
        if (!link || !link.hash) {
            return;
        }

        const target = document.getElementById(decodeURIComponent(link.hash.slice(1)));
        if (!target) {
            return;
        }

        const searchInput = document.getElementById('schema-combined-search');
        if (target.classList.contains('hidden-row') && searchInput && searchInput.value) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input', { bubbles: true }));
        }

        target.classList.remove('schema-target-flash');
        window.setTimeout(() => target.classList.add('schema-target-flash'), 0);
        window.setTimeout(() => target.classList.remove('schema-target-flash'), 1600);
    }

    onReady(() => {
        const rows = Array.from(document.querySelectorAll('tr[data-schema-term][data-schema-kind]'));
        if (rows.length === 0) {
            return;
        }

        const labels = window.location.pathname.includes('/ja/') ? I18N.ja : I18N.en;
        const rowIndex = new Map(rows.map((row) => [keyFor(row.dataset.schemaKind, row.dataset.schemaTerm), row]));
        const references = buildReferences(rows, rowIndex);

        rows.forEach((row) => {
            const rowKey = keyFor(row.dataset.schemaKind, row.dataset.schemaTerm);
            installReferenceDetails(row, references.get(rowKey) || [], labels);
        });

        document.addEventListener('click', flashLinkedRow);
    });
}());
