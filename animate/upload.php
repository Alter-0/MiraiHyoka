<?php

class imp{

    /**
     * 上传ctext正文内容插图
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function uploadCtextValueImg(Request $request) {
        // 判断当前用户是否已经登录
        IsLogin();
        $file   = $request->file('image');
        //获取文件扩展名
        $ext      = $file->extension();
        //保存路径前缀
        $savePath = config("globalconst.xxx")."/".date("Y-m-d");
        //保存文件名
        $saveName = time().'.'.$ext;
        //复制文件操作
        $path = $file->storeAs(
            $savePath, $saveName, 'Dict'
        );
        //必须返回json字符串，否则前台会报错
        return ['errno' => 0, 'data' => [config("app.url").'/pb_img/'.$path]];

    }
}