document.getElementById("listen").addEventListener("click", function(event) {
    event.preventDefault();

    if (!this.audio) {
        this.audio = new Audio(this.href);
    }

    if (this.audio.paused) {
        this.audio.play();
    } else {
        this.audio.pause();
        this.audio.currentTime = 0;
    }
});
