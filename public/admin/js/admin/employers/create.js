document.getElementById('companySelect').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const email = selectedOption.getAttribute('data-email');
    document.getElementById('companyEmail').value = email || '';
});
