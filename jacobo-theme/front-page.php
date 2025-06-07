<?php
/**
 * Plantilla para la Página de Inicio Estática.
 */

get_header();
?>

<main id="content" class="pt-16 md:pt-20"> <?php // Padding top para compensar el header fijo. Ajustar si es necesario. ?>

    <!-- =================================================== -->
    <!-- HERO SECTION -->
    <!-- =================================================== -->
    <section id="hero" class="relative bg-azulNoche text-blancoPuro min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 overflow-hidden -z-10">
            <div class="absolute inset-0 bg-gradient-to-br from-azulNoche via-violetaNeon/10 to-cianElectrico/10 animate-pulse-gradient" style="background-size: 300% 300%;"></div>
        </div>

        <div class="container mx-auto px-6 md:px-10 relative z-10">
            <div class="grid md:grid-cols-2 gap-8 xl:gap-16 items-center">
                <!-- Columna Izquierda: Título, Subtítulo, CTA -->
                <div class="text-center md:text-left">
                    <h1 class="font-sora text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 leading-tight">
                        Deja de Crear Contenido.
                        <span class="block sm:inline-block bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">
                            Dirige Campañas Inteligentes.
                        </span>
                    </h1>
                    <p class="font-inter text-lg lg:text-xl text-grisClaro mb-10">
                        Jacobo es tu copiloto de IA que transforma objetivos de marketing en campañas completas y optimizadas. Dile adiós al trabajo manual, hola a la estrategia potenciada.
                    </p>
                    <a href="#"
                       class="inline-block font-inter text-blancoPuro text-lg font-semibold px-10 py-4 rounded-lg
                              bg-gradient-to-r from-cianElectrico to-violetaNeon
                              hover:from-violetaNeon hover:to-cianElectrico
                              transition-all duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-violetaNeon/30">
                        Empezar a Crear con IA
                    </a>
                </div>

                <!-- Columna Derecha: Elemento Interactivo Central (Simulación Visual) -->
                <div id="heroInteractive" class="mt-12 md:mt-0 p-6 bg-gray-800/30 backdrop-blur-md rounded-xl shadow-2xl min-h-[400px] flex flex-col justify-center items-center">
                    <label for="marketingObjective" class="font-inter text-grisClaro mb-2 self-start">Tu Objetivo de Marketing...</label>
                    <input type="text" id="marketingObjective" name="marketingObjective"
                           class="w-full p-3 rounded-md bg-gray-700/50 text-blancoPuro border border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none transition-colors"
                           placeholder="Ej: Vender mi nueva colección de zapatillas">

                    <div class="mt-6 w-full text-center text-grisClaro">
                        <p class="text-sm mb-2">(Al escribir, aquí aparecerán tarjetas animadas representando los entregables de la campaña)</p>
                        <div class="flex justify-around items-center h-48 opacity-50">
                            <div class="p-4 bg-gray-700/50 rounded-lg shadow-md text-xs transform -rotate-6">Post Instagram</div>
                            <div class="p-4 bg-gray-700/50 rounded-lg shadow-md text-xs transform scale-110">Email</div>
                            <div class="p-4 bg-gray-700/50 rounded-lg shadow-md text-xs transform rotate-6">Anuncio Facebook</div>
                        </div>
                        <p class="text-xs mt-4">(Líneas de energía conectarán estas tarjetas a un logo central de Jacobo - Fase 2)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================== -->
    <!-- SECCIÓN PROBLEMA/SOLUCIÓN -->
    <!-- =================================================== -->
    <section id="problema-solucion" class="py-16 md:py-24 bg-azulNoche border-t border-b border-gray-700/50">
        <div class="container mx-auto px-6 md:px-10">
            <h2 class="font-sora text-3xl md:text-4xl font-bold text-center mb-6">
                Del Caos Manual a la <span class="bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">Orquesta de IA</span>.
            </h2>
            <p class="font-inter text-lg text-grisClaro text-center max-w-3xl mx-auto mb-12 md:mb-16">
                El marketing tradicional es un laberinto de herramientas desconectadas. Jacobo unifica tu estrategia, automatiza la creación y optimiza tus resultados.
            </p>
            <div class="grid md:grid-cols-2 gap-8 xl:gap-12 items-center">
                <!-- Izquierda: El Caos Manual -->
                <div class="p-8 bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50">
                    <h3 class="font-sora text-2xl font-semibold text-blancoPuro mb-6 text-center">El Caos Manual</h3>
                    <div class="flex flex-wrap justify-center items-center gap-4 opacity-70">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro"><title>Planillas</title><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5M3.375 19.5a1.125 1.125 0 00-1.125-1.125M16.125 4.5h1.125c.621 0 1.125.504 1.125 1.125V19.5m-1.125-15H9.375c-.621 0-1.125.504-1.125 1.125V19.5m1.125-15V4.5m0 15V4.5m0 15h7.5m0-15h-7.5M7.125 7.5h3.375m-3.375 3h3.375m-3.375 3h3.375M13.125 7.5h3.375m-3.375 3h3.375m-3.375 3h3.375M4.5 19.5v-2.25a2.25 2.25 0 00-2.25-2.25H1.5V1.5A.75.75 0 012.25 0h19.5a.75.75 0 01.75.75v14.25h-.75a2.25 2.25 0 00-2.25 2.25v2.25m-17.25 0h17.25" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro transform -rotate-6"><title>Docs</title><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125V17.25m0 3.375V17.25m0 3.375c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-1.125-3.375V11.25c0-1.026-.423-1.954-1.125-2.625m-5.25 0V7.875m0 9.375m0-9.375c0-1.026.423-1.954 1.125-2.625M12 10.875h-.008v-.004H12v.004z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro"><title>Social Media Apps</title><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro transform rotate-2"><title>Email Mktg</title><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.023.55m0 0l-4.66 2.51m16.538-11.218a.75.75 0 00-.926-.582l-16.5 7.5a.75.75 0 000 1.366l16.5 7.5a.75.75 0 00.926-.582V9.518z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro"><title>Analytics</title><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro transform translate-y-1"><title>Ads Manager</title><path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" /></svg>
                    </div>
                    <p class="font-inter text-sm text-grisClaro mt-6 text-center">Tiempo perdido, oportunidades fugaces, resultados inciertos.</p>
                </div>
                <!-- Derecha: La Orquesta de IA -->
                <div class="p-8 bg-gradient-to-br from-cianElectrico/10 to-violetaNeon/10 rounded-xl shadow-2xl border border-cianElectrico/30">
                    <h3 class="font-sora text-2xl font-semibold text-blancoPuro mb-6 text-center">La Orquesta de IA con Jacobo</h3>
                     <div class="flex flex-wrap justify-center items-center gap-4 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro p-2 border border-cianElectrico/30 rounded-lg bg-gray-700/30"><title>Planillas</title><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5M3.375 19.5a1.125 1.125 0 00-1.125-1.125M16.125 4.5h1.125c.621 0 1.125.504 1.125 1.125V19.5m-1.125-15H9.375c-.621 0-1.125.504-1.125 1.125V19.5m1.125-15V4.5m0 15V4.5m0 15h7.5m0-15h-7.5M7.125 7.5h3.375m-3.375 3h3.375m-3.375 3h3.375M13.125 7.5h3.375m-3.375 3h3.375m-3.375 3h3.375M4.5 19.5v-2.25a2.25 2.25 0 00-2.25-2.25H1.5V1.5A.75.75 0 012.25 0h19.5a.75.75 0 01.75.75v14.25h-.75a2.25 2.25 0 00-2.25 2.25v2.25m-17.25 0h17.25" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro p-2 border border-cianElectrico/30 rounded-lg bg-gray-700/30"><title>Docs</title><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125V17.25m0 3.375V17.25m0 3.375c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-1.125-3.375V11.25c0-1.026-.423-1.954-1.125-2.625m-5.25 0V7.875m0 9.375m0-9.375c0-1.026.423-1.954 1.125-2.625M12 10.875h-.008v-.004H12v.004z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro p-2 border border-cianElectrico/30 rounded-lg bg-gray-700/30"><title>Social Media Apps</title><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro p-2 border border-cianElectrico/30 rounded-lg bg-gray-700/30"><title>Email Mktg</title><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.023.55m0 0l-4.66 2.51m16.538-11.218a.75.75 0 00-.926-.582l-16.5 7.5a.75.75 0 000 1.366l16.5 7.5a.75.75 0 00.926-.582V9.518z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro p-2 border border-cianElectrico/30 rounded-lg bg-gray-700/30"><title>Analytics</title><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-grisClaro p-2 border border-cianElectrico/30 rounded-lg bg-gray-700/30"><title>Ads Manager</title><path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" /></svg>
                        <?php /* Placeholder para líneas de conexión (Fase 2)
                        <div class="absolute inset-0 flex justify-center items-center opacity-30 -z-1">
                            <svg width="100%" height="100%" viewBox="0 0 200 100">
                                <line x1="50" y1="10" x2="150" y2="90" stroke="url(#lineGradient)" stroke-width="1"/>
                                <line x1="50" y1="90" x2="150" y2="10" stroke="url(#lineGradient)" stroke-width="1"/>
                                <defs><linearGradient id="lineGradient"><stop offset="0%" stop-color="#00F6FF"/><stop offset="100%" stop-color="#C000FF"/></linearGradient></defs>
                            </svg>
                        </div>
                        */ ?>
                    </div>
                    <p class="font-inter text-sm text-grisClaro mt-6 text-center">Estrategia unificada, creación eficiente, impacto medible.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================== -->
    <!-- SECCIÓN DE FUNCIONALIDADES -->
    <!-- =================================================== -->
    <section id="funcionalidades" class="py-16 md:py-24 bg-azulNoche">
        <div class="container mx-auto px-6 md:px-10">
            <h2 class="font-sora text-3xl md:text-4xl font-bold text-center mb-4">Todo tu Marketing, <span class="bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">Potenciado por IA</span>.</h2>
            <p class="font-inter text-lg text-grisClaro text-center max-w-2xl mx-auto mb-12 md:mb-16">
                Jacobo no es solo un generador de contenido. Es una plataforma integral que piensa, crea y optimiza contigo.
            </p>
            <div class="grid md:grid-cols-3 gap-8 xl:gap-12">
                <?php
                $funcionalidades = [
                    [
                        'titulo' => 'Generación de Campañas Completas',
                        'descripcion' => 'Desde un simple objetivo, Jacobo estructura y crea todos los contenidos para tus campañas multicanal.',
                        'icono_svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-cianElectrico mx-auto mb-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.82m5.84-2.56v4.82a6 6 0 01-1.732 4.23l0 0c-.148.242-.364.459-.6.643v-4.82m3.492-2.56l0 0c.148.242.364.459.6.643m-3.492-2.56l0 0c-.148-.242-.364-.459-.6-.643m3.492 2.56l-1.087-1.919m-1.087 1.919l-1.087-1.919m0 0l1.087-1.919L9.41 8.63m0 0L7.25 5.226m2.16 3.404L6.243 6.226m0 0L3.492 8.63m0 0L1.33 5.226m2.162 3.404L1.33 5.226m11.272 1.919l-1.087-1.919m1.087 1.919l1.087 1.919m0 0l-1.087 1.919m0 0l1.087 1.919m0 0l-1.087 1.919m0 0l1.087 1.919L14.41 8.63m0 0L12.25 5.226m2.16 3.404L11.243 6.226m0 0L8.492 8.63m0 0L6.33 5.226m2.162 3.404L6.33 5.226m11.272 1.919l1.087 1.919m-1.087-1.919L21.75 5.226m-2.16 3.404L22.757 6.226m0 0L20.008 8.63m0 0l2.742 2.377m0 0l-2.742 2.377m2.742-2.377l2.742-2.377M1.33 11.007l2.742 2.377m-2.742-2.377l2.742-2.377" /></svg>'
                    ],
                    [
                        'titulo' => 'Análisis Proactivo y Sugerencias',
                        'descripcion' => 'Jacobo monitorea tendencias y el rendimiento de tu contenido, sugiriendo nuevas campañas e ideas.',
                        'icono_svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-cianElectrico mx-auto mb-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.354a15.054 15.054 0 01-4.5 0M3.75 10.5h16.5M3.75 12h16.5m-16.5 3h16.5m-16.5 1.5h16.5M5.25 4.875c0-.164.013-.328.038-.491A2.25 2.25 0 015.25 3V2.25a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V3c0 .414.336.75.75.75h3.75a.75.75 0 01.75.75v.75c0 .414.336.75.75.75h.75a2.25 2.25 0 012.25 2.25v1.5a2.25 2.25 0 01-.309 1.161l-6.32 8.107a2.25 2.25 0 01-1.62.787H9.375a2.25 2.25 0 01-1.62-.787L1.437 12.411A2.25 2.25 0 011.125 11.25v-1.5A2.25 2.25 0 013.375 7.5H4.5c.414 0 .75-.336.75-.75V6c0-.414.336.75.75-.75h.75c.025-.163.038-.327.038-.491z" /></svg>'
                    ],
                    [
                        'titulo' => 'Integración con tu Tienda',
                        'descripcion' => 'Conecta tu catálogo de productos para generar campañas de lanzamiento y ofertas personalizadas.',
                        'icono_svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-cianElectrico mx-auto mb-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>'
                    ]
                ];
                foreach ($funcionalidades as $func) : ?>
                <div class="p-8 bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50 hover:border-cianElectrico/50 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-5xl mb-6 text-center"><?php echo $func['icono_svg']; ?></div> <?php // Placeholder para gráfico animado ?>
                    <h3 class="font-sora text-xl font-semibold text-blancoPuro mb-3 text-center"><?php echo $func['titulo']; ?></h3>
                    <p class="font-inter text-sm text-grisClaro text-center"><?php echo $func['descripcion']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =================================================== -->
    <!-- SECCIÓN DE PRUEBA SOCIAL (TESTIMONIOS) -->
    <!-- =================================================== -->
    <section id="testimonios" class="py-16 md:py-24 bg-azulNoche border-t border-gray-700/50">
        <div class="container mx-auto px-6 md:px-10">
            <h2 class="font-sora text-3xl md:text-4xl font-bold text-center mb-12 md:mb-16">
                Amado por Marketers, <span class="bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">Confiado por Empresas</span>.
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $testimonios = [
                    [
                        'texto' => '"Jacobo ha revolucionado nuestra forma de crear campañas. Lo que antes tomaba semanas, ahora se hace en días, ¡con mejores resultados!"',
                        'autor' => 'Ana L., CMO en TechSolutions',
                        'avatar_svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blancoPuro"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
                    ],
                    [
                        'texto' => '"La capacidad de análisis y las sugerencias proactivas son simplemente increíbles. Es como tener un estratega IA en el equipo."',
                        'autor' => 'Carlos M., Fundador de EcomGrowth',
                        'avatar_svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blancoPuro"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
                    ],
                    [
                        'texto' => '"Desde que usamos Jacobo, nuestro engagement ha subido un 150%. La IA realmente entiende a nuestra audiencia."',
                        'autor' => 'Sofía R., Social Media Manager',
                        'avatar_svg' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blancoPuro"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
                    ]
                ];
                foreach ($testimonios as $test) : ?>
                <div class="p-6 bg-gray-800/30 backdrop-blur-sm rounded-xl shadow-lg border border-gray-700/50">
                    <p class="font-inter text-grisClaro italic mb-6">"<?php echo $test['texto']; ?>"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-violetaNeon flex items-center justify-center mr-3"><?php echo $test['avatar_svg']; ?></div>
                        <div>
                            <p class="font-sora text-blancoPuro font-semibold"><?php echo $test['autor']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =================================================== -->
    <!-- CTA FINAL -->
    <!-- =================================================== -->
    <section id="cta-final" class="py-16 md:py-24 bg-gradient-to-r from-cianElectrico/10 to-violetaNeon/10">
        <div class="container mx-auto px-6 md:px-10 text-center">
            <h2 class="font-sora text-3xl md:text-4xl lg:text-5xl font-bold text-blancoPuro mb-6">
                ¿Listo para la <span class="bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">Magia del Marketing IA</span>?
            </h2>
            <p class="font-inter text-lg text-grisClaro max-w-xl mx-auto mb-10">
                Únete a la revolución. Prueba Jacobo gratis y comprueba cómo la inteligencia artificial puede transformar tu marketing.
            </p>
            <a href="#"
               class="inline-block font-inter text-blancoPuro text-xl font-semibold px-12 py-5 rounded-lg
                      bg-gradient-to-r from-cianElectrico to-violetaNeon
                      hover:from-violetaNeon hover:to-cianElectrico
                      transition-all duration-300 ease-in-out transform hover:scale-105 shadow-xl hover:shadow-violetaNeon/40">
                Empezar Gratis Ahora
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
?>
