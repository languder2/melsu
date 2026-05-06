$(document).ready(function (){
    if ($.fn.select2) {

        $('.jq-select2').select2({
            width: '100%',
            placeholder: $(this).data('placeholder'),
        })

        $('.jq-select2-withID').select2({
            width: '100%',
            placeholder: $(this).data('placeholder'),
            templateResult: formatSelect2Option,
            templateSelection: formatSelect2Selection,
            escapeMarkup: function(markup) {
                return markup;
            }
        })

        function parseStateText(state) {
            if (state.id && state.text.includes('|')) {
                const [id, name] = state.text.split('|');
                return { id: id.trim(), name: name.trim() };
            }
            return null;
        }

        function formatSelect2Option(state) {
            const parsed = parseStateText(state);

            return parsed
                ? `<div class="grid grid-cols-[auto_1fr] gap-3">
                    <span class="s2-id-badge text-gray-700 min-w-[4ch] text-right">#${parsed.id}</span>
                    <span class="s2-text">${parsed.name}</span>
                   </div>`
                : state.text;
        }

        function formatSelect2Selection(state) {
            const parsed = parseStateText(state);
            return parsed ? parsed.name : state.text;
        }


    }
})
