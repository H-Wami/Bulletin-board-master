$(function () {

  // いいねをした時のハートアイコン・数の表示機能
  $(document).on('click', '.like_btn', function (e) {
    e.preventDefault(); // like_btnを押したら、イベントに対するデフォルトの動作をキャンセルする(ページ移動しない)
    $(this).addClass('bi bi-heart-fill unlike_btn'); // unlike_btn表示
    $(this).removeClass('bi bi-heart like_btn'); // like_btn非表示
    var post_id = $(this).attr('post_id'); // post_idを取得して代入する

    // 非同期通信
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }, // ajax通信時のヘッダーにトークンを含める
      method: "post", // 送信メソッドpost
      url: "/post/like/" + post_id, // url指定
      data: {
        post_id: $(this).attr('post_id'), // 送信するデータ
      },
    }).done(function (res) { // 成功した時
      console.log(res);
    }).fail(function (res) { // 失敗した時
      console.log('fail');
    });
  });

  // いいねを解除した時のハートアイコン・数の表示機能
  $(document).on('click', '.unlike_btn', function (e) {
    e.preventDefault(); // like_btnを押したら、イベントに対するデフォルトの動作をキャンセルする(ページ移動しない)
    $(this).removeClass('bi bi-heart-fill unlike_btn'); // unlike_btn非表示
    $(this).addClass('bi bi-heart like_btn'); // like_btn表示
    var post_id = $(this).attr('post_id'); // post_idを取得して代入する

    // 非同期通信
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }, // ajax通信時のヘッダーにトークンを含める
      method: "post", // 送信メソッドpost
      url: "/post/unlike/" + post_id, // url指定
      data: {
        post_id: $(this).attr('post_id'), // 送信するデータ
      },
    }).done(function (res) { // 成功した時
      console.log(res);
    }).fail(function (res) { // 失敗した時
      console.log('fail');
    });
  });

});
