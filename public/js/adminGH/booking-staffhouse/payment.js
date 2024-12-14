document.addEventListener('DOMContentLoaded', function () {
    const positionSelect = document.getElementById('positionStaffHouse');
    const paymentSelect = document.getElementById('payment');
    function updatePaymentOptions() {
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
    updatePaymentOptions();
    positionSelect.addEventListener('change', updatePaymentOptions);
});
