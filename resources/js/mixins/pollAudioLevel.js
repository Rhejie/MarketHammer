const AudioContext = window.AudioContext || window.webkitAudioContext;
const audioContext = AudioContext ? new AudioContext() : null;

export default {


    methods: {
        rootMeanSquare(samples) {
            const sumSq = samples.reduce((sumSq, sample) => sumSq + sample * sample, 0);
            return Math.sqrt(sumSq / samples.length);
        },

        async getPollAudioLevel(track, onLevelChanged, trackLevels = true) {
            let vm = this

            if (!audioContext) {
                return;
            }

            // Due to browsers' autoplay policy, the AudioContext is only active after
            // the user has interacted with your app, after which the Promise returned
            // here is resolved.
            await audioContext.resume();

            // Create an analyser to access the raw audio samples from the microphone.
            const analyser = audioContext.createAnalyser();
            analyser.fftSize = 1024;
            analyser.smoothingTimeConstant = 0.5;

            // Connect the LocalAudioTrack's media source to the analyser.
            const stream = new MediaStream([track.mediaStreamTrack]);
            const source = audioContext.createMediaStreamSource(stream);
            source.connect(analyser);

            const samples = new Uint8Array(analyser.frequencyBinCount);
            let level = null;

            // Periodically calculate the audio level from the captured samples,
            // and if changed, call the callback with the new audio level.
            requestAnimationFrame(function checkLevel() {
                analyser.getByteFrequencyData(samples);
                const rms = vm.rootMeanSquare(samples);
                const log2Rms = rms && Math.log2(rms);

                // Audio level ranges from 0 (silence) to 10 (loudest).
                const newLevel = Math.ceil(100 * log2Rms / 8);
                if (level !== newLevel) {
                    level = newLevel;
                    onLevelChanged(level);
                }

                // Continue calculating the level only if the audio track is live.
                if (trackLevels && track.mediaStreamTrack.readyState === 'live') {
                    requestAnimationFrame(checkLevel);
                } else if (trackLevels){
                    requestAnimationFrame(() => onLevelChanged(0));
                }
            });
        }
    }
}