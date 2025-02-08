@extends('back.layouts.admin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Certificate')
@section('content')


<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h2>Certificate of Indigency</h2>
        <button class="btn btn-primary" onclick="printDiv()">Print</button>
    </div>

    <div id="printable" class="p-5 border bg-white mt-3">
        <!-- Watermark -->
        <div class="position-absolute top-50 start-50 translate-middle opacity-25" style="z-index: -1;">
            <img src="{{ asset('images/watermark-logo.png') }}" alt="Watermark" style="width: 60%;">
        </div>

        @livewire('certificate-header', ['request' => $request])
        @livewire('certificate-content', ['resident_id' => $request->resident_id])
        @livewire('certificate-footer')
    </div>
</div>

@endsection

@section('scripts')
    <script>
        function printDiv() {
            var printContents = document.getElementById("printable").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
