function updateAnalogClock(clock) {
  const now = new Date();
  const sec = now.getSeconds();
  const min = now.getMinutes();
  const hour = now.getHours();

  const secDeg = sec * 6;
  const minDeg = min * 6 + sec * 0.1;
  const hourDeg = (hour % 12) * 30 + min * 0.5;

  const secHand = clock.querySelector(".hand.second");
  const minHand = clock.querySelector(".hand.minute");
  const hourHand = clock.querySelector(".hand.hour");

  if (secHand) secHand.style.transform = `rotate(${secDeg}deg)`;
  if (minHand) minHand.style.transform = `rotate(${minDeg}deg)`;
  if (hourHand) hourHand.style.transform = `rotate(${hourDeg}deg)`;
}

function updateDigitalCounter(wrapper) {
  const dateStr = wrapper.getAttribute("data-start-date");
  if (!dateStr) return;

  const startDate = new Date(dateStr.replace(' ', 'T'));
  const now = new Date();
  const diff = now - startDate;
  if (diff < 0) return;

  const totalSeconds = Math.floor(diff / 1000);
  const days = Math.floor(totalSeconds / (3600 * 24));
  const hours = Math.floor((totalSeconds % (3600 * 24)) / 3600);
  const minutes = Math.floor((totalSeconds % 3600) / 60);
  const seconds = totalSeconds % 60;

  const output = `${days}d : ${String(hours).padStart(2, '0')}h : ${String(minutes).padStart(2, '0')}m : ${String(seconds).padStart(2, '0')}s`;

  const display = wrapper.querySelector(".digital-clock");
  if (display) display.textContent = output;

  console.log("Parsed start date:", startDate);
console.log("Now:", new Date());
console.log("Diff (ms):", now - startDate);

}

document.addEventListener("DOMContentLoaded", () => {
  const clocks = document.querySelectorAll(".analog-clock-wrapper");

  clocks.forEach(clock => {
    updateAnalogClock(clock);
    updateDigitalCounter(clock);
    setInterval(() => {
      updateAnalogClock(clock);
      updateDigitalCounter(clock);
    }, 1000);
  });
});
