const Handlebars = require('handlebars');

const urlAttr = 'data-onchange-url';
const nameAttr = 'data-onchange-name';
const templateAttr = 'data-onchange-template';
const inputsAttr = 'data-onchange-inputs';

export default function() {
    window.addEventListener('DOMContentLoaded', main);
}

function main() {
    const views = document.querySelectorAll(`[${inputsAttr}]`);

    views.forEach(view => {
        getViewModifyingInputs(view)
            .forEach(input => {
                input.addEventListener('change', updateView(view))
            });
    });
}

function getViewModifyingInputs(view) {
    return view
        .getAttribute(inputsAttr)
        .trim()
        .split(' ')
        .map(id => document.getElementById(id))
        .filter(x => x);
}

function updateView(view) {
    const url = view.getAttribute(urlAttr);
    const templateId = view.getAttribute(templateAttr);
    const source = document.getElementById(templateId).innerHTML;
    const template = Handlebars.compile(source);

    const inputs = getViewModifyingInputs(view);

    return event => {
        const elem = event.target;
        const name = elem.getAttribute(nameAttr);

        const params =  inputs
            .map(input => ({
                name: input.getAttribute(nameAttr),
                value: input.value
            }))
            .map(({name, value}) => `${name}=${value}`)
            .join('&');

        console.log(params);
        fetch(`${url}?${params}`)
            .then(res => res.json())
            .then(data => {
                view.innerHTML = template({bacs: data});
            });
    };
}