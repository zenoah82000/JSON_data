# 實體json檔讀取實作

使用前端技術讀取實體.json檔案並作資料顯示

## ajax
1. 透過ajax，撈取實體test.json檔案資料
2. 透過jQuery each迴圈將資料一筆筆帶入指定位置顯示
3. flex區塊顯示

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
