<template>
  <div id="app" :data-theme="theme">
    <nav-bar @switchClicked="changeTheme($event)" :theme="theme" > </nav-bar>
    <router-view></router-view>
  </div>
</template>
<script>
import TopNavBar from "../components/layout/TopNavBar";
export default {
  components: {
    TopNavBar
  },
  data() {
    return {
      theme: ""
    };
  },
  mounted() {
    const body = document.body;
    this.theme = localStorage.getItem("theme");
    if (this.theme === "dark") {
      body.setAttribute("data-theme", "dark");
    }

    // body.setAttribute('data-theme','dark');
  },
  methods: {
    changeTheme() {
      const body = document.body;

      if (this.theme === "" || this.theme !== "dark") {
        body.setAttribute("data-theme", "dark");
        localStorage.setItem("theme", "dark");
        this.theme = "dark";
      } else {
        body.setAttribute("data-theme", "");
        localStorage.setItem("theme", "light");
        this.theme = "";
      }
    }
  }
};
</script>
<style lang="scss">
.router-link-active {
  color:red;
}</style>
