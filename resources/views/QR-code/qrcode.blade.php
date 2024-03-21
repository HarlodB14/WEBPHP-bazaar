<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container mx-auto text-center">
    <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-1/3 lg:w-1/6 px-4 mb-8">
            <p class="mb-2">Simple</p>
            <a href="#" id="container" class="block">{!! $simple !!}</a>
            <button id="download" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onclick="downloadSVG()">Download SVG
            </button>
        </div>
        <div class="w-full md:w-1/3 lg:w-1/6 px-4 mb-8">
            <p class="mb-2">Color Change</p>
            {!! $changeColor !!}
        </div>
        <div class="w-full md:w-1/3 lg:w-1/6 px-4 mb-8">
            <p class="mb-2">Background Color Change</p>
            {!! $changeBgColor !!}
        </div>
        <div class="w-full md:w-1/3 lg:w-1/6 px-4 mb-8">
            <p class="mb-2">Style Square</p>
            {!! $styleSquare !!}
        </div>
        <div class="w-full md:w-1/3 lg:w-1/6 px-4 mb-8">
            <p class="mb-2">Style Dot</p>
            {!! $styleDot !!}
        </div>
        <div class="w-full md:w-1/3 lg:w-1/6 px-4 mb-8">
            <p class="mb-2">Style Round</p>
            {!! $styleRound !!}
        </div>
    </div>
</div>
<script>
    function downloadSVG() {
        const svg = document.getElementById('container').innerHTML;
        const blob = new Blob([svg.toString()]);
        const element = document.createElement("a");
        element.download = "w3c.svg";
        element.href = window.URL.createObjectURL(blob);
        element.click();
        element.remove();
    }
</script>
