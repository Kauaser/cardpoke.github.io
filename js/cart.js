// Variável global para armazenar o carrinho
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Função para atualizar o carrinho no localStorage
function updateCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

// Função para atualizar o contador do carrinho na navbar
function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        cartCount.textContent = cart.length;
    }
}

// Função para adicionar um item ao carrinho
function addToCart(productId, productName, productPrice) {
    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity += 1; // Incrementa a quantidade se o item já existir
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
    }
    updateCart();
}

// Função para remover um item do carrinho
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
    renderCartItems(); // Atualiza imediatamente a renderização dos itens
}

// Função para exibir o carrinho
function showCart() {
    const cartModal = `
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Seu Carrinho</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                            </tbody>
                        </table>
                        <h5>Total: R$ <span id="cart-total">0.00</span></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', cartModal);

    const modal = new bootstrap.Modal(document.getElementById('cartModal'));
    modal.show();

    renderCartItems();
}

// Função para renderizar os itens do carrinho
function renderCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    if (!cartItemsContainer || !cartTotal) return;

    cartItemsContainer.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
        const row = `
            <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>R$ ${(item.price * item.quantity).toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removeFromCart('${item.id}')">Remover</button></td>
            </tr>
        `;
        cartItemsContainer.insertAdjacentHTML('beforeend', row);
        total += item.price * item.quantity;
    });

    cartTotal.textContent = total.toFixed(2);
}

// Evento para abrir o modal do carrinho
document.getElementById('cart-button')?.addEventListener('click', (e) => {
    e.preventDefault();
    showCart();
});

// Inicializa o contador do carrinho ao carregar a página
updateCartCount();

