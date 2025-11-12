document.querySelectorAll('.card a').forEach(link => {
    link.addEventListener('mouseover', () => link.style.color = 'blue');
    link.addEventListener('mouseout', () => link.style.color = 'black');
});
