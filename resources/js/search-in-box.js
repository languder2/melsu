// document.addEventListener('DOMContentLoaded', () => {
//     const lists = document.querySelectorAll('.specialities_filter');
//
//     if (!lists) return false;
//
//     lists.forEach(el => {
//         const form = el.closest('form');
//         const groupSearch = form.getAttribute('data-group-search');
//         const cards = document.querySelectorAll(groupSearch);
//
//         el.addEventListener('change', () => {
//             showAll(cards);
//
//             const formData = new FormData(form);
//             formData.forEach((value, field) => {
//                 const type = form.querySelector(`[name="${field}"]`).getAttribute('data-filter-type');
//
//                 if (type === 'check' && value !== '') {
//                     check(cards, field, value);
//                 }
//
//                 if (type === 'search' && value !== '') {
//                     search(cards, value);
//                 }
//             });
//         });
//     });
//
//     const showAll = (cards) => cards.forEach(card => card.setAttribute('checked', 'true'));
//     const check = (cards, field, value) =>
//         cards.forEach(card => card.dataset[field] !== value || card.setAttribute('checked', 'true'));
//     const search = (cards, value) =>
//         cards.forEach(card => card.value.includes(value) || card.setAttribute('checked', 'true'));
// });
