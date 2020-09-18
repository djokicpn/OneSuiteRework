<template>
  <div>
    <router-link
      :to="{ name: name }"
      v-slot="{ href, navigate, isActive, isExactActive }"
    >
      <li
        :class="[
          isActive && 'router-link-active',
          isExactActive && 'router-link-exact-active',
        ]"
      >
        <a :href="href" @click="navigate"><slot></slot></a>
      </li>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "li-link",
  props: ["name"],
  mounted() {
    console.log(this.name);
  },
};
</script>
