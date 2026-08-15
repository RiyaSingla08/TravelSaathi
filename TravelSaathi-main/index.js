// Update Budget Value Display
const budgetSlider = document.getElementById('budgetRange');
const budgetValue = document.getElementById('budget-value');

budgetSlider.oninput = function () {
    budgetValue.textContent = parseInt(this.value).toLocaleString();
};

// Tab Switching Logic (Optional)
const tabButtons = document.querySelectorAll('.tab-btn');

tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        tabButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});
