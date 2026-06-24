<x-layouts.app title="Check In">
    <div class="mx-auto grid max-w-4xl gap-6 lg:grid-cols-[1fr_360px]">
        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-semibold">Scan QR</h1>
            <div class="mt-5 overflow-hidden rounded-lg border border-zinc-200 bg-zinc-950">
                <video id="qr-video" class="aspect-video w-full object-cover" muted playsinline></video>
            </div>
            <div class="mt-4 flex gap-3">
                <button id="start-scan" type="button" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">Start Camera</button>
                <button id="stop-scan" type="button" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium hover:bg-zinc-50">Stop</button>
            </div>
            <p id="scan-status" class="mt-3 text-sm text-zinc-600">Ready to scan supported QR codes.</p>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-semibold">Verify Ticket</h2>
            <form method="POST" action="{{ route('admin.checkin.store') }}" class="mt-6 space-y-4">
                @csrf
                <label class="block">
                    <span class="text-sm font-medium">Ticket code</span>
                    <input id="ticket-code" name="ticket_code" value="{{ old('ticket_code') }}" required class="mt-1 w-full rounded-md border-zinc-300 font-mono" placeholder="EVT-2026-000001">
                    @error('ticket_code') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <button class="w-full rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Verify Ticket</button>
            </form>
        </section>
    </div>

    <script>
        const video = document.getElementById('qr-video');
        const input = document.getElementById('ticket-code');
        const status = document.getElementById('scan-status');
        let stream;
        let timer;

        const parseTicketCode = (rawValue) => {
            try {
                return JSON.parse(rawValue).ticket_code || rawValue;
            } catch {
                return rawValue;
            }
        };

        document.getElementById('start-scan').addEventListener('click', async () => {
            if (!('BarcodeDetector' in window)) {
                status.textContent = 'QR scanning is not supported by this browser.';
                return;
            }

            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
            video.srcObject = stream;
            await video.play();

            const detector = new BarcodeDetector({ formats: ['qr_code'] });
            timer = window.setInterval(async () => {
                const codes = await detector.detect(video);
                if (codes.length === 0) {
                    return;
                }

                input.value = parseTicketCode(codes[0].rawValue);
                status.textContent = `Scanned ${input.value}`;
            }, 700);
        });

        document.getElementById('stop-scan').addEventListener('click', () => {
            window.clearInterval(timer);
            stream?.getTracks().forEach((track) => track.stop());
            status.textContent = 'Camera stopped.';
        });
    </script>
</x-layouts.app>
