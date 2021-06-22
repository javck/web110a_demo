<html>
  <head>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js"
      defer
    ></script>
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
  </head>

  <body>
    <div class="main" x-data="init()">
      <h4 class="font-xxlarge">用 Alpine.js 來尋找商品</h4>
      <div class="searchArea">
        <input
          class="inputText"
          type="text"
          placeholder="請輸入關鍵字"
          x-model="q"
        />
        <button class="bg-default" @click="search()">尋找</button>
      </div>
      <div>
        <template x-for="result in results">
          <div class="postCard">
            <div>
              <img x-bind:src="result.pic" />
            </div>
            <div>
              <div class="postDetailItem">
                <span style="padding-right: 5px">名稱:</span
                ><span><b x-text="result.name">可口可樂</b></span>
              </div>
              <div class="postDetailItem">
                <span style="padding-right: 5px">內容:</span
                ><p x-html="result.desc">Hello,World</p>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
    <script>
        var myHeaders = new Headers();
        myHeaders.append("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZW1vLnRlc3RcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MjQzNTYxODQsImV4cCI6MTYyNDM1OTc4NCwibmJmIjoxNjI0MzU2MTg0LCJqdGkiOiJsVTBNU0NYOUkwd0VDRDV3Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.BE7TM6r9_pl54Csz2HYm6N-1S80-VGU0yPuBrWlLldA");

        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };

      function init() {
        return {
          results: [],
          q: "",
          search: function () {
            fetch(
              "http://demo.test/api/products/query?s=" +
                this.q
            ,requestOptions)
              .then((response) => response.json())
              .then((response) => (this.results = response.data))
              .catch((err) => console.log(err));
          },
        };
      }
    </script>
  </body>
</html>
