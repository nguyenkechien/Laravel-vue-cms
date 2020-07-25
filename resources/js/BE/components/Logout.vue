<template>
  <div></div>
</template>
<script>
export default {
  mounted: () => {
    // document.getElementById("logout-form").submit();
    const form = $('#logout-form');
    const $token = $('[name="x-token"]');
    form.append(`<input name="token" value="${$token.attr('content')}">`);
    form.submit();
  }
};
</script>
