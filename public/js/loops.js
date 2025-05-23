document.addEventListener('DOMContentLoaded', () => {
    const waves = {};

    document.querySelectorAll('audio[id^="audio-"]').forEach(audio => {
        const id = audio.id.replace('audio-', '');
        createWaveform(id);
    });

    function createWaveform(id) {
        const audio = document.getElementById('audio-' + id);
        const waveform = WaveSurfer.create({
            container: '#waveform-' + id,
            waveColor: '#457b9d',
            progressColor: '#e63946',
            backgroundColor: '#000',
            height: 80,
            responsive: true,
            barWidth: 2,
            cursorColor: '#fff',
        });

        waveform.load(audio.src);
        waves[id] = waveform;

        waveform.on('play', () => updateButtonIcon(id, '⏸ Pausar'));
        waveform.on('pause', () => updateButtonIcon(id, '▶ Reproducir'));
        waveform.on('finish', () => updateButtonIcon(id, '▶ Reproducir'));
    }

    window.togglePlay = function(id) {
        if (waves[id]) {
            waves[id].playPause();
        }
    }

    function updateButtonIcon(id, text) {
        const btn = document.getElementById('btn-' + id);
        if (btn) {
            const span = btn.querySelector('.icon');
            if (span) span.textContent = text;
        }
    }
});
