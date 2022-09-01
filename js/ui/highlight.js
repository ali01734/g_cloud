import _ from 'lodash';

export default function() {
    document.addEventListener("DOMContentLoaded", addEventListeners);
}

function addEventListeners() {
    const theClass = 'highlighted';
    const highlighted = document.querySelectorAll(`.${theClass}`);

    const handler = makeListener(highlighted, theClass);
    _.forEach(highlighted, h => {
        h.addEventListener('focus', handler);
    });
}

function makeListener(nodeList, theClass) {
    return function removeClass() {
        _.forEach(nodeList, element => {
            element.classList.remove(theClass);
        });
    };
}