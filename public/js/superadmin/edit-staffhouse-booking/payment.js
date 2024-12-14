document.addEventListener('DOMContentLoaded', function () {
    const positionSelect = document.getElementById('editPositionStaffHouse');
    const paymentSelect = document.getElementById('edit-payment');

    function updatePaymentOptions1() {
        const selectedPosition = positionSelect.value;
        paymentSelect.innerHTML = '';

        const cashOption = document.createElement('option');
        cashOption.value = 'Cash';
        cashOption.textContent = 'Cash';
        paymentSelect.appendChild(cashOption);

        if (selectedPosition !== 'Student' && selectedPosition !== 'Guest') {
            const salaryDeductionOption = document.createElement('option');
            salaryDeductionOption.value = 'Salary Deduction';
            salaryDeductionOption.textContent = 'Salary Deduction';
            paymentSelect.appendChild(salaryDeductionOption);
        }
    }

    updatePaymentOptions1();

    positionSelect.addEventListener('change', updatePaymentOptions1);
});
