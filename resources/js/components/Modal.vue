<template>
  <div v-if="showModal">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{ title }}</h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true" @click="$emit('close')"
                    >&times;</span
                  >
                </button>
              </div>
              <div class="modal-body text-left ">
                <slot></slot>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  @click="$emit('close')"
                >
                  {{ buttonClose }}
                </button>
                <button
                  @click="$emit('save-clicked')"
                  type="button"
                  class="btn btn-primary"
                >
                  {{ buttonSave }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  name: "modal",
  props: ["name", "title", "buttonSave", "buttonClose"],
  data() {
    return {
      showModal: true,
    };
  },
};
</script>
