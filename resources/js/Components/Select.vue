<template>
  <keep-alive>
    <select id="aaa" class="tw-select" data-te-select-init
      :data-te-select-filter="filterValue"
      :data-te-select-size="sizeValue">
      <option value="option1">Option 1</option>
      <option value="option2">Option 2</option>
      <option value="option3">Option 3</option>
    </select>
  </keep-alive>
</template>

<script>
import { Select, initTE } from "tw-elements";
export default {
  beforeRouteEnter (to, from, next) {
    alert('aaa')
    // Reinitialize the library when entering the route.
    initTE({ Select });
    next();
  },
  data() {
    return {
      filterValue: true, // Set the filter attribute value based on your logic
      sizeValue: 'lg' // Set the size attribute value based on your logic
    };
  },
  mounted() {
    // Initialize Tailwind Elements select component
    initTE({ Select });

  },
  watch() {

    initTE({ Select });


  },
  created() {
    // Retrieve the selected option value from the query parameter
    initTE({ Select });

  },
  beforeDestroy() {
    // Cleanup logic before the component is destroyed
    initTE({ Select });
  },
  beforeRouteUpdate(to, from, next) {
    initTE({ Select });
    // Update select box data or reset its state here
    next();
  }
};
</script>
