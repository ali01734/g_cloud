'use strict';

export default function() {
    window.addEventListener('DOMContentLoaded', main);
}

const sidebar = document.querySelector('.exercise-sidebar');
const topBar = document.querySelector('.top-bar');
const footer = document.querySelector('#footer');

function main() {
    if (sidebar) {
        resizeClientArea();
        onScroll();
        window.addEventListener('scroll', onScroll);
    }
}

function resizeClientArea() {
    let contentArea = document.querySelector('.base-sidebar-content');
    contentArea.style.minHeight = `${sidebar.clientHeight}px`;
}

function onScroll() {
    sidebar.style.top = 0;
    blockSideBarTop(topBar.clientHeight, sidebar);
    blockSideBarBottom(footer, sidebar);
}

function blockSideBarBottom() {
    if (window.scrollY + window.innerHeight > footer.offsetTop)
        sidebar.style.top = (-(window.scrollY + window.innerHeight - footer.offsetTop)) + 'px'
}

function blockSideBarTop() {
    console.log(window.scrollY < topBar.clientHeight);
    sidebar.style.top = window.scrollY < topBar.clientHeight ?
    topBar.clientHeight - window.scrollY + 'px' : '0';
}
