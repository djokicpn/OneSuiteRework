<template>
  <nav
    class="navbar navbar-expand-md navbar-light bg-white shadow-sm"
    :dark-theme="theme"
  >
    <div class="container-fluid">

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation}}"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link exact :to="{ name: 'Home' }" class="nav-link"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link exact :to="{ name: 'qa-general' }" class="nav-link"
              >QA Portal</router-link
            >
          </li>
          
        </ul>
      </div>
      <div class="custom-control custom-switch">
        <input
          type="checkbox"
          class="custom-control-input"
          id="customSwitch1"
          value="dark"
          v-model="checkedTheme"
          @click="emitSwitch"
        />
        <label class="custom-control-label" for="customSwitch1"></label>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'nav-bar',
  props: ["theme"],
  data() {
    return {
      checkedTheme: false,
    };
  },
  methods: {
    emitSwitch() {
      this.$emit("switchClicked", this.theme);
    }
  },
  mounted() {
    this.checkedTheme = localStorage.getItem("theme") === "dark" ? true : false;
  },
};
</script>
