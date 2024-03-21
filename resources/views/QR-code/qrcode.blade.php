<link href="https://cdn.tailwindcss.com/latest.min.css" rel="stylesheet">

<div class="container mx-auto text-center">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="col-span-1 md:col-span-1 lg:col-span-1">
            <p class="mb-0">Simple</p>
            <a href="" id="container" class="inline-block">{!! $simple !!}</a><br/>
            <button id="download" class="mt-2 btn btn-info text-light bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg"
                    onclick="downloadSVG()">Download SVG
            </button>
        </div>
        <div class="col-span-1 md:col-span-1 lg:col-span-1">
            <p class="mb-0">Color Change</p>
            {!! $changeColor !!}
        </div>
        <div class="col-span-1 md:col-span-1 lg:col-span-1">
            <p class="mb-0">Background Color Change</p>
            {!! $changeBgColor !!}
        </div>

        <div class="col-span-1 md:col-span-1 lg:col-span-1">
            <p class="mb-0">Style Square</p>
            {!! $styleSquare !!}
        </div>
        <div class="col-span-1 md:col-span-1 lg:col-span-1">
            <p class="mb-0">Style Dot</p>
            {!! $styleDot !!}
        </div>
        <div class="col-span-1 md:col-span-1 lg:col-span-1">
            <p class="mb-0">Style Round</p>
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
