export function LimitList(selectID, attr, value) {
    let select = document.getElementById(selectID);

    if (select === null) return false;

    let options = select.querySelectorAll('option');

    options.forEach(option => {
        if (option.value === '') return '';

        if (option.getAttribute(attr) === value) {
            option.removeAttribute('disabled');
            option.classList.remove('hidden');

        } else {
            option.setAttribute('disabled', 'disabled');
            option.classList.add('hidden');
        }
    });

    select.value = '';
}

export function DepartmentsByFaculty(selectFaculty, selectDepartment) {
    selectFaculty = document.getElementById(selectFaculty);
    selectDepartment = document.getElementById(selectDepartment);

    if (selectFaculty === null || selectDepartment === null) return false;

    let href = '/api/departments-by-faculty-shorts/' + selectFaculty.value;

    fetch(href, {
        method: "GET",
    })
        .then(response => {
            return response.text();
        })
        .then(data => {

            let options = selectDepartment.querySelectorAll('option:not([value=""])');
            options.forEach(option => option.remove());

            options = JSON.parse(data);

            for (let key in options) {
                selectDepartment.appendChild(new Option(options[key], key));

            }
        });


}
