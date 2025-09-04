const carritoBtn = document.querySelector('.nav-link.btn-outline-light[position-relative]');
const carritoModal = document.getElementById('carrito-modal');
const carritoLista = document.getElementById('carrito-lista');
const carritoTotal = document.getElementById('carrito-total');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
const cerrarCarritoBtn = document.getElementById('cerrar-carrito');

let carrito = [];
let total = 0;

// Abrir carrito al hacer click en el ícono
document.querySelector('.nav-item.position-relative a').addEventListener('click', function(e) {
  e.preventDefault();
  carritoModal.style.display = carritoModal.style.display === 'none' ? 'block' : 'none';
});

// Agregar productos al carrito
document.querySelectorAll('.agregar-carrito').forEach(boton => {
  boton.addEventListener('click', function() {
    const card = this.closest('.producto');
    const nombre = card.querySelector('.card-title').textContent;
    const precio = parseInt(card.querySelector('.card-text').textContent.replace('$',''));
    
    carrito.push({ nombre, precio });
    total += precio;

    actualizarCarrito();
  });
});

// Actualizar visual del carrito
function actualizarCarrito() {
  carritoLista.innerHTML = '';
  carrito.forEach((producto, index) => {
    const li = document.createElement('li');
    li.className = 'list-group-item d-flex justify-content-between align-items-center';
    li.innerHTML = `${producto.nombre} - $${producto.precio} <button class="btn btn-sm btn-outline-danger eliminar" data-index="${index}">X</button>`;
    carritoLista.appendChild(li);
  });
  carritoTotal.textContent = total;

  // Botón eliminar individual
  document.querySelectorAll('.eliminar').forEach(boton => {
    boton.addEventListener('click', function() {
      const idx = this.dataset.index;
      total -= carrito[idx].precio;
      carrito.splice(idx, 1);
      actualizarCarrito();
    });
  });

  // Actualizar contador en navbar
  document.getElementById('cart-count').textContent = carrito.length;
}

// Vaciar carrito
vaciarCarritoBtn.addEventListener('click', function() {
  carrito = [];
  total = 0;
  actualizarCarrito();
});

// Cerrar carrito
cerrarCarritoBtn.addEventListener('click', function() {
  carritoModal.style.display = 'none';
});