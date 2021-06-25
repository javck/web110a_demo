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
        //記得替換成你環境所給的Token，而且每小時要換一次
        myHeaders.append("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9kZW1vLnRlc3RcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MjQ1ODAwNDQsImV4cCI6MTYyNDU4MzY0NCwibmJmIjoxNjI0NTgwMDQ0LCJqdGkiOiJpcExCWUZiUUVqWVhPdmpUIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.-lw0HK7d4cf28kYm-V1xK-g8ipjnBgKrD7_CZ7SqJ8g");

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
              //記得將demo.test替換成你專案的實際網址
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
