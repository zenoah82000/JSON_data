# json 讀取 練習實作

使用前端技術讀取實體.json檔案或是網路JSON API 並作資料顯示

搭配第三方cors-anywhere 解決跨網域存取問題

## ajax
1. 透過第三方cors-anywhere重新架構API連結
2. 透過ajax，撈取API資料
3. 透過jQuery each迴圈將資料一筆筆帶入指定位置顯示
4. flex區塊顯示

## fetch
1. 透過fetch，撈取實體test.json檔案資料
2. 透過map將資料一筆筆帶出建立顯示樣式
3. 資料表格顯示

## Request
1. 建立async函式，透過new Request，撈取實體test.json檔案資料
2. 透過await fetch將資料帶出
3. 利用append將資料帶入下拉選單
4. 建立監聽事件，將下拉選單值透過filter找出對應資料
5. 將對應資料完整印出
