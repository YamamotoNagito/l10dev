import { computed } from "vue";
import { useDisplay } from "vuetify";

export function useItemsPerPage() {
  const { mobile } = useDisplay();

  return computed(() => (mobile.value ? 5 : 10));
}
