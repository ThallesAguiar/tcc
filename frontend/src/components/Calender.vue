<template>
  <date-picker v-model="date" :config="options"></date-picker>
</template>

<script>
import datePicker from "vue-bootstrap-datetimepicker";
import "pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css";

export default {
  components: {
    datePicker,
  },
  data: () => ({
    date: new Date(),
    options: {
      format: "DD/MM/YYYY",
      useCurrent: false,
    },
  }),
};
</script>
