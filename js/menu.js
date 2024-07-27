const { createApp, ref } = Vue;

const app = createApp({
  setup() {
    const scrollY = ref(0);
    const elY = ref(0);

    const onScroll = () => {
      const el = document.querySelector("#header");
      const height = el.getBoundingClientRect().height;
      const pos = window.scrollY;
      const diff = scrollY.value - pos;

      elY.value = Math.min(0, Math.max(-height, elY.value + diff));
      el.style.position =
        pos >= height ? "fixed" : pos === 0 ? "absolute" : el.style.position;
      el.style.transform = `translateY(${
        el.style.position === "fixed" ? elY.value : 0
      }px)`;

      //TODO Сделать чтобы при скроле вниз открытая менюшка тоже убиралась

      scrollY.value = pos;
    };

    window.addEventListener("scroll", onScroll);

    return {
      scrollY,
      elY,
    };
  },
});

app.mount("#app");

$(document).ready(function () {
  $("#sidebar-active").change(function () {
    if ($(this).is(":checked")) {
      $("body").addClass("overflow-hidden");
    } else {
      $("body").removeClass("overflow-hidden");
    }
  });
});
