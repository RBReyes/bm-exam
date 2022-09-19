<template>
  <div
    id="pagination-right-component"
    class="tab-pane tab-example-result fade active show"
    role="tabpanel"
    aria-labelledby="pagination-right-component-tab"
  >
    <!-- <nav aria-label="Page navigation example"> -->
    <ul class="pagination justify-content-end pagination-sm">
      <li class="page-item" :class="_page == 1 ? 'disabled' : ''">
        <span class="page-link" @click="pageClick(_page - 1)">
          <i class="fa fa-angle-left"></i>
          <span class="sr-only" :aria-disabled="_page == 1"><<</span>
        </span>
      </li>

      <template v-if="!_isSimple">
        <li class="page-item" v-if="!totalPages.includes(1)">
          <span class="page-link" @click="pageClick(1)">1</span>
        </li>
        <template v-for="(p, index) in totalPages">
          <li
            class="page-item"
            :class="_page == p ? 'active' : ''"
            v-if="p != 0"
            :key="index"
          >
            <span class="page-link" @click="pageClick(p)">{{ p }}</span>
          </li>
        </template>

        <li class="page-item" v-if="!totalPages.includes(_lastPage)">
          <span
            class="page-link"
            @click="pageClick(totalPages[totalPages.length - 1] + 1)"
            >...</span
          >
        </li>
        <li class="page-item" v-if="!totalPages.includes(_lastPage)">
          <span class="page-link" @click="pageClick(_lastPage)">{{
            _lastPage
          }}</span>
        </li>
      </template>
      <li
        class="page-item"
        :class="_lastPage && _page == _lastPage ? 'disabled' : ''"
      >
        <span class="page-link" @click="pageClick(_page + 1)">
          <i class="fa fa-angle-right"></i>
          <span class="sr-only " :aria-disabled="_lastPage && _page == _lastPage"
            >>></span
          >
        </span>
      </li>
    </ul>
    <!-- </nav> -->
  </div>
</template>

<script>
export default {
  name: "Pagination",
  props: ["_lastPage", "_page", "_total", "_per_page", "_isSimple"],
  data() {
    return {};
  },
  computed: {
    totalPages: function () {
      let totalPages = this._lastPage;
      let currentPage = this._page;
      let range = 4;
      let paging = [];
      let start = 1;

      if (currentPage < range / 2 + 1) {
        start = 1;
      } else if (currentPage >= totalPages - range / 2) {
        start = Math.floor(totalPages - range + 1);
      } else {
        start = currentPage - Math.floor(range / 2);
      }

      if (totalPages > range)
        for (let i = start; i <= start + range - 1; i++) {
          paging.push(i);
        }
      else
        for (let i = start; i <= totalPages; i++) {
          paging.push(i);
        }

      return paging;
    },
  },
  methods: {
    pageClick(page = 1) {
      this.$emit("pageClicked", page);
    },
  },
  filters: {},
};
</script>

<style lang="scss" scoped>
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #fcb040;
    border-color: #fcb040;
}
.page-link {
    color: #fcb040;
}

</style>