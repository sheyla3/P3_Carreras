<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caballos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="app.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script
        src="https://www.paypal.com/sdk/js?client-id=AUZKr_7whtWWgrCWVv9uufg_7qoUhlutwgnkv2P-xjtl6FM3g0WGZG_7bMO_hVoRxsR5Bjr9_XcOhXhM&currency=EUR">
    </script>
    <style>
        .vertical-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #paymentSuccessModal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 60%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
            z-index: 999;
        }

        #paymentSuccessModal p {
            font-size: 18px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content-3 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content-2 {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            display: flex;
            /* Establecer la visualización en modo flex */
        }

        .left-section {
            background: white;
            flex: 1;
            /* Hacer que la sección izquierda ocupe el 50% del ancho */
            padding-right: 20px;
            box-shadow: 0 5px 10px rgb(0 0 0 / 25%);
        }

        .right-section {
            flex: 1;
            /* Hacer que la sección derecha ocupe el 50% del ancho */
            padding-left: 20px;
        }

        /* Estilos para el botón de cerrar */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

<style>
        .piece {
        width: 150px;
        height: 150px;
        cursor: pointer;
        margin-left: 6px;
        margin-top: 6px;
        position: absolute;
        background-color: red;
        background-size: cover;
    }
    .drop-zone {
      width: 150px;
      height: 150px;
      padding: 5px;
      border: 1px dashed #000;
      position: absolute;
    }

    .row1 {
      top: 0;
    }

    .row2 {
      top: 155px;
    }

    .row3 {
      top: 310px;
    }

    .col1 {
      left: 0;
    }

    .col2 {
      left: 155px;
    }

    .col3 {
      left: 310px;
      
    }

    .container-drak-and-drop {
        position: absolute;
        top: 25%;
        left: 30%;
        width: 700px;
        height: 500px;
        border: 5px black;
        background: rgb(255, 255, 255);
        box-shadow: 10px 5px 10px rgb(0 0 0 / 25%);

    }
</style>
</head>

<body>
    @if (isset($socioId) && isset($socioName))
        @include('layouts.CHSocio')
    @elseif (isset($jineteId) && isset($jineteName))
        @include('layouts.CHJinete')
    @else
        @include('layouts.CaballoHeader')
    @endif
    <div class="enlacesHeader">
        <h1 class="float-left tituloHeader2">Tickets</h1>
        @include('layouts.2Header')
    </div>
    <div class="contenedor-tickets">
        @foreach ($carreras as $carrera)
            <div class="carrera">
                <div class="carrera-img">
                    <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" width="378px" height="342px"
                        alt="{{ $carrera->nombre }}">
                </div>

                <div class="datos">
                    <div id="datos-title">
                        <h2 class="text-break">{{ $carrera->nombre }}</h2>
                    </div>
                    <div>
                        <p class="text-break">{{ $carrera->descripcion }}</p>
                    </div>
                    <div>
                        <p class="text-break">{{ \Carbon\Carbon::parse($carrera->fechaHora)->format('d-m-Y - H:i') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-break">{{ $carrera->precio }} €</h3>
                    </div>
                </div>

                <div class="jinetes">
                    <a href="{{ route('listaJinetes', $carrera->id_carrera) }}">Jinetes</a>
                </div>

                <div class="clasificacion">
                    <!-- Agregar un atributo data-title al botón para obtener el título de la carrera -->
                    <button class="buy-btn" data-title="{{ $carrera->nombre }}"
                        data-description="{{ $carrera->descripcion }}" data-id="{{ $carrera->id_carrera }}"
                        data-price="{{ $carrera->precio }}">Comprar</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-3">
        <nav aria-label="Page navigation" class="paginacion text-dark">
            <ul class="pagination justify-content-center pagination-sm">
                @if ($carreras->lastPage() > 1)
                    @for ($i = 1; $i <= $carreras->lastPage(); $i++)
                        <li class="page-item {{ $carreras->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $carreras->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif
            </ul>
        </nav>
        <div class="text-center">
            {{ $carreras->firstItem() }} / {{ $carreras->lastItem() }} de {{ $carreras->total() }} carreras
        </div>
    </div>
    <div id="myModal" class="modal" onclick="closeDetailsModal(event)">
        <div class="modal-content-2">
            <span class="close">&times;</span>
            <div class="left-section">
                <!-- Sección izquierda del modal -->
                <div class="modal-details ml-5 mt-4">
                    <h2 id="modal-title"></h2>
                    <p id="modal-description" class="text-break"></p>
                    <h3 id="modal-price"></h3>
                </div>
                <div class="modal-incrementor ml-5">
                    <!-- Aumentador -->
                    <button id="decrement" class="btn bg-transparent"><img src="{{ asset('img/decrementa.svg') }}"
                            width="30" height="30" alt="-"></button>
                    <span id="quantity" class="h4">1</span>
                    <button id="increment" class="btn bg-transparent"><img src="{{ asset('img/incrementa.svg') }}"
                            width="30" height="30" alt="+"></button>
                </div>
            </div>
            <div class="right-section">
                <!-- Sección derecha del modal -->
                <h2>Resumen</h2>
                <h3>Subtotal:</h3>
                <h3 id="subtotal"></h3>
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
    <div id="paymentSuccessModal" class="modal">
        <div class="modal-content-3">
            <span class="close" onclick="closePaymentModal()">&times;</span>
            <div class="vertical-content">
                <p>Pago completado con éxito</p>
                <div id="purchaseDetails"></div> <!-- Div para mostrar los detalles de la compra -->
                <a id="invoiceLink" onclick="generateInvoiceUrl()" class="btn btn-info">Imprimir Factura & Entradas</a>
            </div>
        </div>
    </div>
    <script>
        // Función para mostrar el modal de detalles y ocultar el modal de pago realizado
        function showDetailsModal(title, description, price) {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            document.getElementById("modal-title").innerText = title;
            document.getElementById("modal-description").innerText = description;
            document.getElementById("modal-price").innerText = price + " €";
            calculateTotalPrice();
        }

        // Función para mostrar el modal de pago realizado y construir la URL de la factura PDF
        function showPaymentSuccessModal() {
            var detailsModal = document.getElementById("myModal");
            detailsModal.style.display = "none";
            var paymentModal = document.getElementById("paymentSuccessModal");
            paymentModal.style.display = "block";

            // Obtener los datos del modal de detalles
            var title = document.getElementById("modal-title").innerText;
            var description = document.getElementById("modal-description").innerText;
            var price = document.getElementById("modal-price").innerText;

            // Mostrar los detalles de la compra en el div de purchaseDetails
            var purchaseDetailsDiv = document.getElementById("purchaseDetails");
            purchaseDetailsDiv.innerHTML = "<p><strong>Título:</strong> " + title + "</p>" +
                "<p><strong>Descripción:</strong> " + description + "</p>" +
                "<p><strong>Precio:</strong> " + price + "</p>";
        }

        function generateInvoiceUrl() {
            var invoiceUrl = "{{ route('FacturaPDF', ['subtotal' => ':subtotal', 'total_quantity' => ':total_quantity', 'carrera_id' => ':carrera_id']) }}";
            invoiceUrl = invoiceUrl.replace(':subtotal', PrecioTotal);
            invoiceUrl = invoiceUrl.replace(':total_quantity', cantidad);
            invoiceUrl = invoiceUrl.replace(':carrera_id', carreraId);

            // Redirigir a la URL de la factura PDF
            window.location.href = invoiceUrl;
        }

        function closePaymentModal() {
            var modal = document.getElementById("paymentSuccessModal");
            modal.style.display = "none";
        }

        function closeDetailsModal(event) {
            var modalContent = document.querySelector('.modal-content-2');
            var isClickInsideModal = modalContent.contains(event.target);
            if (!isClickInsideModal) {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
            }
        }

        // Obtener el botón que abre el modal
        var btns = document.getElementsByClassName("buy-btn");

        // Manejo de incremento y decremento del número de compras
        var incrementButton = document.getElementById('increment');
        var decrementButton = document.getElementById('decrement');
        var quantitySpan = document.getElementById('quantity');
        var priceSpan = document.getElementById('modal-price');
        var originalPrice = 0; // Variable para almacenar el precio original de la carrera

        incrementButton.addEventListener('click', function() {
            quantitySpan.innerText = parseInt(quantitySpan.innerText) + 1;
            calculateTotalPrice();
        });

        decrementButton.addEventListener('click', function() {
            if (parseInt(quantitySpan.innerText) > 1) {
                quantitySpan.innerText = parseInt(quantitySpan.innerText) - 1;
                calculateTotalPrice();
            }
        });

        function calculateTotalPrice() {
            var quantity = parseInt(quantitySpan.innerText);
            var totalPrice = originalPrice * quantity;
            document.getElementById('subtotal').innerText = totalPrice + " €";
            PrecioTotal = totalPrice;
            cantidad = quantity;
        }

        // Guardar datos de la carrera y factura
        var carreraId, PrecioTotal, cantidad;
        // Cuando se hace clic en el botón, abrir el modal de detalles
// Cuando se hace clic en el botón "Comprar", mostrar el área de "Drag and Drop"
for (var i = 0; i < btns.length; i++) {
    btns[i].onclick = function() {
        var title = this.getAttribute('data-title');
        var description = this.getAttribute('data-description');
        var id = this.getAttribute('data-id');
        var price = parseFloat(this.getAttribute('data-price')); // Convertir el precio a un número flotante
        originalPrice = price; // Guardar el precio original de la carrera
        carreraId = id; // darle el valor del id
        // Ocultar el modal de detalles
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
        // Mostrar el área de "Drag and Drop"
        var dragAndDropContainer = document.getElementById("dragAndDropContainer");
        dragAndDropContainer.style.display = "block";
        // Actualizar el título y descripción si es necesario
        document.getElementById("modal-title").innerText = title;
        document.getElementById("modal-description").innerText = description;
        document.getElementById("modal-price").innerText = price + " €";
        calculateTotalPrice();
    }
}


        // PayPal Integration
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('subtotal').innerText.replace(' €',
                                ''), // Obtener el subtotal sin el símbolo de euro
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Callback cuando el pago es aprobado
                return actions.order.capture().then(function(details) {
                    // Ocultar el modal de detalles y mostrar el modal de pago realizado
                    showPaymentSuccessModal();
                });
            },
            onCancel: function(data) {
                alert("Pago cancelado")
            }
        }).render('#paypal-button-container');
    </script>




<div id="dragAndDropContainer" class="container-drak-and-drop" style="display: none;">
    <div class="piezas">
        <div draggable="true" class="piece" id="piece1" style="top: 0; left: 500px; background-image: url('{{ asset('img/9.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece5" style="top: 0; left: 500px; background-image: url('{{ asset('img/5.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece3" style="top: 0; left: 500px; background-image: url('{{ asset('img/7.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece9" style="top: 0; left: 500px; background-image: url('{{ asset('img/1.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece4" style="top: 0; left: 500px; background-image: url('{{ asset('img/6.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece7" style="top: 0; left: 500px; background-image: url('{{ asset('img/3.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece2" style="top: 0; left: 500px; background-image: url('{{ asset('img/8.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece6" style="top: 0; left: 500px; background-image: url('{{ asset('img/4.jpg') }}');"></div>
        <div draggable="true" class="piece" id="piece8" style="top: 0; left: 500px; background-image: url('{{ asset('img/2.jpg') }}');"></div>
        <button id="continueButton" style="position: absolute; top: 400px; left: 535px;">Continuar</button>

    </div>

    <div class="drop-zone row1 col1" data-position="1"></div>
    <div class="drop-zone row1 col2" data-position="2"></div>
    <div class="drop-zone row1 col3" data-position="3"></div>
    <div class="drop-zone row2 col1" data-position="4"></div>
    <div class="drop-zone row2 col2" data-position="5"></div>
    <div class="drop-zone row2 col3" data-position="6"></div>
    <div class="drop-zone row3 col1" data-position="7"></div>
    <div class="drop-zone row3 col2" data-position="8"></div>
    <div class="drop-zone row3 col3" data-position="9"></div>
</div>

  <script>
    function handleDragStart(e) {
      e.dataTransfer.setData("text/plain", "Heu deixat caure quelcom!");
      e.dataTransfer.setData("text", e.target.id);
    }

    function handleDragOver(e) {
      e.preventDefault();
    }

    function handleDrop(e) {
  e.preventDefault();
  const draggedPieceId = e.dataTransfer.getData("text");
  const draggedPiece = document.getElementById(draggedPieceId);
  const dropZone = e.target;

  if (dropZone.classList.contains('drop-zone')) {
    const position = dropZone.getAttribute('data-position');
    const pieceWidth = draggedPiece.offsetWidth;
    const pieceHeight = draggedPiece.offsetHeight;

    // Obtener la posición de la gota
    const dropPosition = parseInt(dropZone.getAttribute('data-position'));

    // Obtener la posición de la pieza
    const piecePosition = parseInt(draggedPieceId.replace('piece', ''));

    // Verificar si la posición de la gota y la pieza coinciden
    if (dropPosition === piecePosition) {
      // Calcular la posición dentro del cuadrado de la zona de destino
      const offsetX = e.offsetX;
      const offsetY = e.offsetY;

      // Ajustar la posición para que la pieza esté centrada en el cuadrado
      const clampedX = Math.min(Math.max(offsetX - pieceWidth / 2, 0), dropZone.offsetWidth - pieceWidth);
      const clampedY = Math.min(Math.max(offsetY - pieceHeight / 2, 0), dropZone.offsetHeight - pieceHeight);

      // Establecer la posición de la pieza dentro del cuadrado de la zona de destino
      draggedPiece.style.top = clampedY + 'px';
      draggedPiece.style.left = clampedX + 'px';

      dropZone.appendChild(draggedPiece);
    }
  }
}


    const pieces = document.querySelectorAll('.piece');
    pieces.forEach(piece => {
      piece.addEventListener('dragstart', handleDragStart);
    });

    const dropZones = document.querySelectorAll('.drop-zone');
    dropZones.forEach(zone => {
      zone.addEventListener('dragover', handleDragOver);
      zone.addEventListener('drop', handleDrop);
    });

// Manejar el evento de clic en el botón "Continuar"
continueButton.addEventListener('click', function() {
    var allImagesPlaced = true;
    var dropZones = document.querySelectorAll('.drop-zone');

    // Verificar si todas las zonas de destino tienen una imagen colocada
    dropZones.forEach(zone => {
        if (zone.children.length === 0) {
            allImagesPlaced = false;
            return;
        }
    });

    // Si todas las imágenes están colocadas, permitir que el usuario continúe
    if (allImagesPlaced) {
        // Ocultar el área de "Drag and Drop"
        var dragAndDropContainer = document.getElementById('dragAndDropContainer');
        dragAndDropContainer.style.display = 'none';

        // Mostrar el modal con la información de la compra
        showDetailsModal();
    } else {
        // Mostrar un mensaje de que las imágenes no se han verificado
        alert('Por favor, coloca todas las imágenes en las zonas de destino antes de continuar.');
    }
});

  </script>
</body>
@include('layouts.footer')

</html>
