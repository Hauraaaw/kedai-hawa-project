let quantity = 1;

function increaseQty() {
    quantity++;
    updateQtyDisplay();
}

function decreaseQty() {
    if (quantity > 1) {
        quantity--;
        updateQtyDisplay();
    }
}

function updateQtyDisplay() {
    const qtyDisplay = document.getElementById('quantity');
    const qtyInput = document.getElementById('qty-input');
    
    if (qtyDisplay) {
        qtyDisplay.textContent = quantity;
    }
    
    if (qtyInput) {
        qtyInput.value = quantity;
    }
}

// Smooth Scroll
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations on page load
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 100);
    
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.border = '2px solid red';
                } else {
                    input.style.border = 'none';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap isi semua field yang diperlukan!');
            }
        });
    });
    
    // Button click effects
    const buttons = document.querySelectorAll('button, .btn-get-started, .btn-login, .btn-add-to-cart, .btn-checkout');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
        });
    });
});

// Add to cart animation
function addToCartAnimation() {
    const cartIcon = document.querySelector('.btn-cart-icon');
    if (cartIcon) {
        cartIcon.style.animation = 'bounce 0.5s ease';
        setTimeout(() => {
            cartIcon.style.animation = '';
        }, 500);
    }
}

// Keyframe animation for cart bounce (defined in CSS would be better, but adding here for completeness)
const style = document.createElement('style');
style.textContent = `
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
`;
document.head.appendChild(style);
