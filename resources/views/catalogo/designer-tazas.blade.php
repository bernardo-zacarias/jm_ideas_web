@extends('layouts.app')

@section('title', 'Diseñador de Tazas 3D - JM Ideas')

@section('content')

<!-- Título Simple Diseñador -->
<div class="bg-white border-b border-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-2">Diseñador de Tazas 3D</h1>
        <p class="text-gray-600 text-lg">Crea tu taza personalizada con visualización realista en 3D</p>
    </div>
</div>

<!-- Contenido principal -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Visualización 3D -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-jm-orange to-orange-500 text-white px-8 py-6 flex justify-between items-center" style="background: linear-gradient(to right, #f97316, #ff6500);">
                    <h2 class="text-2xl font-bold">Vista 3D en Tiempo Real</h2>
                    <button id="autoRotateBtn"
                        class="px-6 py-3 rounded-full font-bold transition shadow-lg text-white hover:shadow-2xl transform hover:scale-105 flex items-center gap-2"
                        style="background-color: rgba(0, 0, 0, 0.3); border: 2px solid white;"
                        onclick="toggleAutoRotate()">
                        <i class="fa-solid fa-gear"></i> Auto-rotar ON
                    </button>
                </div>
                
                <div id="canvas-container" 
                    class="w-full bg-gradient-to-b from-gray-50 to-gray-100"
                    style="height: 550px;">
                </div>

                <div id="rotationControls" class="px-8 py-4 border-t border-gray-200" style="display: none;">
                    <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Rotación Manual: <span id="rotationValue" class="text-jm-orange font-bold">0</span>°
                    </label>
                    <input
                        type="range"
                        id="rotationSlider"
                        min="0"
                        max="360"
                        value="0"
                        class="w-full h-3 bg-gradient-to-r from-jm-orange to-orange-500 rounded-lg appearance-none cursor-pointer accent-jm-orange"
                        onchange="updateManualRotation(this.value)"
                    />
                </div>

                <div class="grid grid-cols-3 gap-3 p-8">
                    <button onclick="saveDesign()"
                        class="text-white py-3 px-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all hover:scale-105"
                        style="background: linear-gradient(to right, #22c55e, #059669);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Guardar
                    </button>
                    <button onclick="exportDesign()"
                        class="text-white py-3 px-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all hover:scale-105"
                        style="background: linear-gradient(to right, #06b6d4, #2563eb);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Descargar
                    </button>
                    <button onclick="rotateDesign(45)"
                        class="text-white py-3 px-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all hover:scale-105"
                        style="background: linear-gradient(to right, #f97316, #ff6500);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Rotar 45°
                    </button>
                </div>
            </div>

            <!-- Panel de control -->
            <div class="space-y-6">
                <!-- Subir imagen -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-jm-orange to-orange-500 text-white px-6 py-4" style="background: linear-gradient(to right, #f97316, #ff6500);">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Tu Diseño
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <input
                            id="imageInput"
                            type="file"
                            accept="image/*"
                            onchange="handleImageUpload(event)"
                            class="hidden"
                        />
                        
                        <button onclick="document.getElementById('imageInput').click()"
                            class="w-full text-white py-3 px-6 rounded-xl transition font-bold flex items-center justify-center gap-2 shadow-lg mb-4"
                            style="background: linear-gradient(to right, #f97316, #ff6500); cursor: pointer;"
                            onmouseover="this.style.opacity='0.9'"
                            onmouseout="this.style.opacity='1'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Subir Imagen
                        </button>

                        <div id="imagePreview" style="display: none;">
                            <img id="previewImg" class="w-full h-32 object-cover rounded-xl border-3 border-jm-orange mb-3 shadow-md" />
                            <button onclick="removeImage()"
                                class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition font-semibold flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Eliminar
                            </button>
                        </div>

                        <div class="p-4 bg-orange-50 rounded-xl border-l-4 border-jm-orange">
                            <p class="text-sm text-gray-700 font-medium">
                                💡 <strong>Consejo:</strong> La imagen se ajustará automáticamente alrededor de toda la taza
                            </p>
                        </div>

                        <!-- Control de posición de la imagen -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                </svg>
                                Posición de Imagen: <span id="offsetValue" class="text-jm-orange font-bold">0</span>%
                            </label>
                            <input
                                type="range"
                                id="offsetSlider"
                                min="-50"
                                max="50"
                                value="0"
                                class="w-full h-3 bg-gradient-to-r from-jm-orange to-orange-500 rounded-lg appearance-none cursor-pointer"
                                onchange="updateImageOffset(this.value)"
                                oninput="updateImageOffset(this.value)"
                            />
                            <p class="text-xs text-gray-600 mt-2 text-center">
                                Desliza para centrar la imagen en la zona de impresión
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Color de la taza -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="text-white px-6 py-4" style="background: linear-gradient(to right, #06b6d4, #0891b2);">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                            Color de la Taza
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <input
                            type="color"
                            id="colorPicker"
                            value="#ffffff"
                            onchange="updateMugColor(this.value)"
                            class="w-full h-16 rounded-xl cursor-pointer border-3 border-gray-300 hover:border-cyan-400 transition shadow-md"
                        />

                        <div class="grid grid-cols-5 gap-2 mt-4">
                            <button onclick="updateMugColor('#ffffff')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-cyan-400 transition shadow-md" style="background-color: #ffffff;" title="Blanco"></button>
                            <button onclick="updateMugColor('#000000')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-cyan-400 transition shadow-md" style="background-color: #000000;" title="Negro"></button>
                            <button onclick="updateMugColor('#e74c3c')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-red-400 transition shadow-md" style="background-color: #e74c3c;" title="Rojo"></button>
                            <button onclick="updateMugColor('#3498db')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-blue-400 transition shadow-md" style="background-color: #3498db;" title="Azul"></button>
                            <button onclick="updateMugColor('#2ecc71')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-green-400 transition shadow-md" style="background-color: #2ecc71;" title="Verde"></button>
                            <button onclick="updateMugColor('#f97316')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-orange-400 transition shadow-md" style="background-color: #f97316;" title="Naranja"></button>
                            <button onclick="updateMugColor('#9b59b6')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-purple-400 transition shadow-md" style="background-color: #9b59b6;" title="Púrpura"></button>
                            <button onclick="updateMugColor('#1abc9c')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-cyan-400 transition shadow-md" style="background-color: #1abc9c;" title="Turquesa"></button>
                            <button onclick="updateMugColor('#e91e63')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-pink-400 transition shadow-md" style="background-color: #e91e63;" title="Rosado"></button>
                            <button onclick="updateMugColor('#f39c12')" class="w-full h-12 rounded-lg border-3 border-gray-300 hover:border-yellow-400 transition shadow-md" style="background-color: #f39c12;" title="Dorado"></button>
                        </div>
                    </div>
                </div>

                <!-- Botón Principal: Guardar y Seleccionar -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border-2 border-jm-orange">
                    <div class="bg-gradient-to-r from-jm-orange to-orange-600 text-white px-6 py-4">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Listo para Continuar
                        </h3>
                    </div>
                    <div class="p-6 text-center space-y-4">
                        <p class="text-gray-700 font-semibold text-lg">Completa tu diseño y guárdalo para seleccionar la taza</p>
                        <button onclick="saveDesign()"
                            class="w-full text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-lg hover:shadow-2xl flex items-center justify-center gap-3 transition-all transform hover:-translate-y-1"
                            style="background: linear-gradient(to right, #f97316, #ff6500);">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Guardar y Seleccionar Taza
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<script>
    // Variables globales
    let scene, camera, renderer, mug, textureLoader;
    let uploadedImage = null;
    let mugColor = '#ffffff';
    let autoRotate = true;
    let rotation = 0;
    let animationId = null;
    let imageOffset = 0; // Control para mover la imagen horizontalmente

    // Inicializar Three.js
    function initThreeJS() {
        const container = document.getElementById('canvas-container');
        
        scene = new THREE.Scene();
        scene.background = new THREE.Color(0xf0f0f0);

        camera = new THREE.PerspectiveCamera(
            45,
            container.clientWidth / container.clientHeight,
            0.1,
            1000
        );
        camera.position.set(0, 0, 6);
        camera.lookAt(0, 0, 0);

        renderer = new THREE.WebGLRenderer({ antialias: true, preserveDrawingBuffer: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.shadowMap.enabled = true;
        container.appendChild(renderer.domElement);

        textureLoader = new THREE.TextureLoader();

        // Luces
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(5, 5, 5);
        directionalLight.castShadow = true;
        scene.add(directionalLight);

        const fillLight = new THREE.DirectionalLight(0xffffff, 0.3);
        fillLight.position.set(-5, 0, -5);
        scene.add(fillLight);

        // Crear taza
        createMug();

        // Suelo con sombra
        const planeGeometry = new THREE.PlaneGeometry(10, 10);
        const planeMaterial = new THREE.ShadowMaterial({ opacity: 0.2 });
        const plane = new THREE.Mesh(planeGeometry, planeMaterial);
        plane.rotation.x = -Math.PI / 2;
        plane.position.y = -1.5;
        plane.receiveShadow = true;
        scene.add(plane);

        animate();

        // Redimensionar cuando cambia tamaño de ventana
        window.addEventListener('resize', onWindowResize);
    }

    function createMug() {
        const mugGroup = new THREE.Group();

        // Cuerpo de la taza
        const bodyGeometry = new THREE.CylinderGeometry(0.8, 0.75, 1.9, 64);
        const bodyMaterial = new THREE.MeshStandardMaterial({
            color: mugColor,
            metalness: 0.05,
            roughness: 0.6,
        });
        const body = new THREE.Mesh(bodyGeometry, bodyMaterial);
        body.castShadow = true;
        body.receiveShadow = true;
        mugGroup.add(body);
        mug = body;

        // Borde superior
        const rimGeometry = new THREE.CylinderGeometry(0.82, 0.8, 0.08, 64);
        const rimMaterial = new THREE.MeshStandardMaterial({
            color: mugColor,
            metalness: 0.1,
            roughness: 0.5,
        });
        const rim = new THREE.Mesh(rimGeometry, rimMaterial);
        rim.position.y = 0.99;
        mugGroup.add(rim);

        // Base
        const baseGeometry = new THREE.CylinderGeometry(0.75, 0.75, 0.06, 64);
        const baseMaterial = new THREE.MeshStandardMaterial({
            color: mugColor,
            metalness: 0.1,
            roughness: 0.6,
        });
        const base = new THREE.Mesh(baseGeometry, baseMaterial);
        base.position.y = -0.98;
        mugGroup.add(base);

        // Asa
        const handleGroup = new THREE.Group();
        const outerRadius = 0.4;
        const tubeRadius = 0.06;
        const handleGeometry = new THREE.TorusGeometry(outerRadius, tubeRadius, 16, 32, Math.PI * 1.65);
        const handleMaterial = new THREE.MeshStandardMaterial({
            color: mugColor,
            metalness: 0.05,
            roughness: 0.6,
        });
        const handle = new THREE.Mesh(handleGeometry, handleMaterial);
        handle.rotation.z = -Math.PI / 10;
        handle.castShadow = true;
        handleGroup.add(handle);

        handleGroup.position.set(0.78, 0.1, 0);
        handleGroup.rotation.y = Math.PI;
        mugGroup.add(handleGroup);

        // Interior
        const innerGeometry = new THREE.CylinderGeometry(0.77, 0.72, 1.85, 64, 1, true);
        const innerMaterial = new THREE.MeshStandardMaterial({
            color: 0xffffff,
            side: THREE.BackSide,
            metalness: 0.1,
            roughness: 0.4,
        });
        const inner = new THREE.Mesh(innerGeometry, innerMaterial);
        inner.position.y = 0.02;
        mugGroup.add(inner);

        scene.add(mugGroup);
    }

    function animate() {
        animationId = requestAnimationFrame(animate);

        if (mug && mug.parent) {
            if (autoRotate) {
                mug.parent.rotation.y += 0.005;
            } else {
                mug.parent.rotation.y = (rotation * Math.PI) / 180;
            }
            mug.parent.position.set(0, 0, 0);
        }

        renderer.render(scene, camera);
    }

    function onWindowResize() {
        const container = document.getElementById('canvas-container');
        const width = container.clientWidth;
        const height = container.clientHeight;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
    }

    function handleImageUpload(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                uploadedImage = event.target.result;
                document.getElementById('previewImg').src = uploadedImage;
                document.getElementById('imagePreview').style.display = 'block';
                updateMugTexture();
            };
            reader.readAsDataURL(file);
        }
    }

    function updateMugTexture() {
        if (uploadedImage && mug) {
            // Cargar la imagen del usuario
            const img = new Image();
            img.onload = function() {
                // Crear un canvas para la textura final con márgenes blancos
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                
                // Llenar con blanco toda la imagen (base para márgenes sin imprimir)
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                
                // Calcular márgenes en píxeles (8% a cada lado para cubrir más área)
                const marginLeft = canvas.width * 0.08;
                const printWidth = canvas.width * 0.84;
                
                // Dibujar la imagen sin desplazamiento horizontal en el canvas
                ctx.drawImage(img, 
                    0, 0, img.width, img.height,
                    marginLeft, 0, printWidth, canvas.height
                );
                
                // Crear textura del canvas y aplicarla
                const texture = new THREE.CanvasTexture(canvas);
                texture.wrapS = THREE.RepeatWrapping;
                texture.wrapT = THREE.RepeatWrapping;
                // La textura se repite una sola vez alrededor de la taza
                texture.repeat.set(1, 1);
                // El offset permite deslizar la textura sin cortarla
                texture.offset.x = imageOffset;
                texture.needsUpdate = true;
                
                const newMaterial = new THREE.MeshStandardMaterial({
                    map: texture,
                    metalness: 0.05,
                    roughness: 0.6,
                });
                
                mug.material.dispose();
                mug.material = newMaterial;
            };
            img.src = uploadedImage;
        }
    }

    function updateMugColor(color) {
        mugColor = color;
        document.getElementById('colorPicker').value = color;
        
        if (mug) {
            if (uploadedImage && mug.material.map) {
                // Mantener textura
            } else {
                const newMaterial = new THREE.MeshStandardMaterial({
                    color: color,
                    metalness: 0.05,
                    roughness: 0.6,
                });
                mug.material.dispose();
                mug.material = newMaterial;
            }
        }
    }

    function removeImage() {
        uploadedImage = null;
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('imageInput').value = '';
        if (mug && mug.material.map) {
            const newMaterial = new THREE.MeshStandardMaterial({
                color: mugColor,
                metalness: 0.05,
                roughness: 0.6,
            });
            mug.material.dispose();
            mug.material = newMaterial;
        }
    }

    function toggleAutoRotate() {
        autoRotate = !autoRotate;
        const btn = document.getElementById('autoRotateBtn');
        const controls = document.getElementById('rotationControls');
        
        if (autoRotate) {
            btn.textContent = '⚙️ Auto-rotar ON';
            btn.classList.remove('bg-gray-400', 'text-gray-800');
            btn.classList.add('bg-white', 'text-jm-orange');
            controls.style.display = 'none';
        } else {
            btn.textContent = '⚙️ Auto-rotar OFF';
            btn.classList.remove('bg-white', 'text-jm-orange');
            btn.classList.add('bg-gray-400', 'text-gray-800');
            controls.style.display = 'block';
        }
    }

    function updateImageOffset(value) {
        // Convertir valor del slider (-50 a 50) a offset (-0.5 a 0.5)
        imageOffset = parseFloat(value) / 100;
        document.getElementById('offsetValue').textContent = Math.round(imageOffset * 100);
        updateMugTexture();
    }

    function updateManualRotation(value) {
        rotation = parseInt(value);
        document.getElementById('rotationValue').textContent = rotation;
    }

    function rotateDesign(degrees) {
        if (!autoRotate) {
            rotation = (rotation + degrees) % 360;
            document.getElementById('rotationSlider').value = rotation;
            document.getElementById('rotationValue').textContent = rotation;
        }
    }

    function saveDesign() {
        // Validar que hay una imagen
        if (!uploadedImage) {
            alert('⚠️ Debes subir una imagen antes de guardar el diseño');
            return;
        }

        const canvas = renderer.domElement;
        const designImageData = canvas.toDataURL('image/png');
        
        // Guardar el diseño en sessionStorage para usarlo después
        const design = {
            id: Date.now(),
            designImage: designImageData,  // Vista 3D del diseño
            uploadedImage: uploadedImage,  // Imagen original que subió el usuario
            mugColor: mugColor,
            timestamp: new Date().toLocaleString()
        };
        
        // Guardar en sessionStorage
        sessionStorage.setItem('customDesign', JSON.stringify(design));
        
        // Mostrar mensaje de confirmación
        alert('✅ Diseño guardado. Ahora selecciona un producto de Tazones para imprimir tu diseño.');
        
        // Redireccionar al catálogo de Tazones con el filtro aplicado
        window.location.href = "{{ route('catalogo.index') . '?category=7' }}";
    }



    function exportDesign() {
        const canvas = renderer.domElement;
        const link = document.createElement('a');
        link.download = 'taza-personalizada-3d.png';
        link.href = canvas.toDataURL();
        link.click();
    }



    function saveCotizacion(design) {
        // Enviar al servidor para guardar en la tabla cotizaciones
        fetch('{{ route("catalogo.saveCotizacion") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                tipo_producto: 'taza',
                imagen_diseño: design.image,
                color_producto: design.mugColor,
                descripcion: 'Diseño de taza personalizada creado en el diseñador 3D',
                notas: JSON.stringify({
                    uploadedImage: design.uploadedImage ? 'Sí' : 'No',
                    timestamp: design.timestamp
                })
            })
        }).then(response => response.json())
          .catch(error => console.error('Error:', error));
    }

    // Inicializar cuando carga la página
    document.addEventListener('DOMContentLoaded', initThreeJS);
</script>

@endsection
