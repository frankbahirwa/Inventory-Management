function handleManage() {
const links = document.querySelectorAll('#manage');
const contents = document.querySelectorAll('.form');
links.forEach(link => {
link.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('form');
content.classList.toggle('active');
});
});
});
}

function stockIn() {
const links = document.querySelectorAll('#stock-in');
const contents = document.querySelectorAll('.stockin');
const clickables = document.querySelectorAll('.remove');
links.forEach(link => {
link.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('stockin');
content.classList.toggle('actives');
});
clickables.forEach(clickable => {
clickable.addEventListener('click', () => {
contents.forEach(content => content.style.display = 'none');
});
});
});
});
}

function stockOut() {
const links = document.querySelectorAll('#stock-out');
const contents = document.querySelectorAll('.stockout');
const clickables = document.querySelectorAll('.remove');
links.forEach(link => {
link.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('stockout');
content.classList.toggle('activens');
});
clickables.forEach(clickable => {
clickable.addEventListener('click', () => {
contents.forEach(content => content.style.display = 'none');
});
});
});
});
}

function handle() {
const links = document.querySelectorAll('#manage');
const contents = document.querySelectorAll('.form');
const invents = document.querySelectorAll('.invents');
invents.forEach(invent => {
invent.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('miles');
content.classList.toggle('blocks');
});
});
});
links.forEach(link => {
link.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('form');
content.classList.toggle('active');
});
});
});
}

function management() {
const invents = document.querySelectorAll('.invents');
const contents = document.querySelectorAll('.form');
const links = document.querySelectorAll('#manage');
invents.forEach(invent => {
invent.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('miles');
content.classList.toggle('blocks');
});
});
});
links.forEach(link => {
link.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('form');
content.classList.toggle('active');
});
});
});
}

function login() {
const links = document.querySelectorAll('#login');
const contents = document.querySelectorAll('.container');
const clickables = document.querySelectorAll('.remove');
links.forEach(link => {
link.addEventListener('click', () => {
contents.forEach(content => {
content.classList.toggle('container');
content.classList.toggle('display');
});
clickables.forEach(clickable => {
clickable.addEventListener('click', () => {
contents.forEach(content => content.style.display = 'none');
});
});
});
});
}


document.addEventListener("DOMContentLoaded", () => {
handleManage();
stockIn();
stockOut();
handle();
management();
login();
});
