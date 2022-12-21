/*добавление/удаление товаров в избранное*/
$(document).ready(function () {
  var svg_add =
    '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 19.2L11.4 17.8C16.6 13.2 20 10.1 20 6.30005C20 3.20005 17.6 0.800049 14.5 0.800049C12.8 0.800049 11.1 1.60005 10 2.90005C8.9 1.60005 7.2 0.800049 5.5 0.800049C2.4 0.800049 0 3.20005 0 6.30005C0 10.1 3.4 13.2 8.6 17.8L10 19.2Z" fill="#4F5964"/></svg>';
  var svg_remove =
    '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 19.2L11.4 17.8C16.6 13.2 20 10.1 20 6.30005C20 3.20005 17.6 0.800049 14.5 0.800049C12.8 0.800049 11.1 1.60005 10 2.90005C8.9 1.60005 7.2 0.800049 5.5 0.800049C2.4 0.800049 0 3.20005 0 6.30005C0 10.1 3.4 13.2 8.6 17.8L10 19.2Z" fill="#4F5964"/></svg>';
  $(document).on('click', '.yupe-store-favorite-add', function (event) {
    event.preventDefault();
    var $this = $(this);
    var product = parseInt($this.data('id'));
    var data = { id: product };
    data[yupeTokenName] = yupeToken;
    $.post(
      yupeStoreAddFavoriteUrl,
      data,
      function (data) {
        if (data.result) {
          $('.js-favorite-total').html(data.count).removeClass('hidden');
          $this
            .removeClass('yupe-store-favorite-add')
            .addClass('yupe-store-favorite-remove')
            .addClass('text-error');
          //$this.html(svg_add);
          $this.find('span').html('В избранном');
          if ($('.but-favorite .toolbar-button').hasClass('no-active')) {
            $('.but-favorite .toolbar-button')
              .removeClass('no-active')
              .addClass('active')
              .html(svg_add);
          }
        }
        showNotify($this, data.result ? 'success' : 'danger', data.data);
      },
      'json'
    );
  });

  $(document).on('click', '.yupe-store-favorite-remove', function (event) {
    event.preventDefault();
    var $this = $(this);
    var product = parseInt($this.data('id'));
    var data = { id: product };
    data[yupeTokenName] = yupeToken;
    $.post(
      yupeStoreRemoveFavoriteUrl,
      data,
      function (data) {
        if (data.result) {
          $('.js-favorite-total').html(data.count);
          $this
            .removeClass('yupe-store-favorite-remove')
            .removeClass('text-error')
            .addClass('yupe-store-favorite-add');
          // $this.html(svg_remove);
          $this.find('span').html('В избранное');
          if (data.count == 0) {
            $('.but-favorite .toolbar-button')
              .removeClass('active')
              .addClass('no-active')
              .html(svg_remove);
            $('.js-favorite-total').addClass('hidden');
          }
        }
        showNotify($this, data.result ? 'success' : 'danger', data.data);
      },
      'json'
    );
  });

  $(document).on('click', '.favorite-delete', function (event) {
    event.preventDefault();
    var $this = $(this);
    var product = parseInt($this.data('id'));
    var data = { id: product };
    data[yupeTokenName] = yupeToken;
    $.post(
      yupeStoreRemoveFavoriteUrl,
      data,
      function (data) {
        if (data.result) {
          $('.js-favorite-total').html(data.count);
          $this.parents('.product-box__item').remove();
          if (data.count == 0) {
            $('.but-favorite .toolbar-button')
              .removeClass('active')
              .addClass('no-active')
              .html(svg_remove);
            $('.list-view .favorite-box').html(
              '<span class="empty">Нет результатов.</span>'
            );
          }
        }
        showNotify($this, data.result ? 'success' : 'danger', data.data);
      },
      'json'
    );
  });

  $(document).on('click', '.yupe-product-favorite-add', function (event) {
    event.preventDefault();
    var $this = $(this);
    var product = parseInt($this.data('id'));
    var data = { id: product };
    data[yupeTokenName] = yupeToken;
    $.post(
      yupeStoreAddFavoriteUrl,
      data,
      function (data) {
        if (data.result) {
          $('.js-favorite-total').html(data.count);
          $this
            .removeClass('yupe-product-favorite-add')
            .addClass('yupe-product-favorite-remove')
            .addClass('text-error');
          $this.children('i').removeClass('fa-star-o').addClass('fa-star');
          $this.children('span').text('Удалить из избранного');
          if ($('.but-favorite .toolbar-button').hasClass('no-active')) {
            $('.but-favorite .toolbar-button')
              .removeClass('no-active')
              .addClass('active')
              .html(svg_add);
          }
        }
        showNotify($this, data.result ? 'success' : 'danger', data.data);
      },
      'json'
    );
  });

  $(document).on('click', '.yupe-product-favorite-remove', function (event) {
    event.preventDefault();
    var $this = $(this);
    var product = parseInt($this.data('id'));
    var data = { id: product };
    data[yupeTokenName] = yupeToken;
    $.post(
      yupeStoreRemoveFavoriteUrl,
      data,
      function (data) {
        if (data.result) {
          $('.js-favorite-total').html(data.count);
          $this
            .removeClass('yupe-product-favorite-remove')
            .removeClass('text-error')
            .addClass('yupe-product-favorite-add');
          $this.children('i').removeClass('fa-star').addClass('fa-star-o');
          $this.children('span').text('Добавить в избранное');
          if (data.count == 0) {
            $('.but-favorite .toolbar-button')
              .removeClass('active')
              .addClass('no-active')
              .html(svg_remove);
          }
        }
        showNotify($this, data.result ? 'success' : 'danger', data.data);
      },
      'json'
    );
  });
});
