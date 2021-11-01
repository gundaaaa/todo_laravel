<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\SinupRequest;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        return view('sinup', ['msg' => ''], ['mmm' => '']);
    }
    // postで送って来たデータをDBに保存している。
    public function post(SinupRequest $request)
    {
        // postから送られて来たデータを$paramに格納している。  
        $param = [
            'name' => $request->msg,
            'message' => $request->mmm,
        ];
        // ⇓データベースに情報を入れている。
        DB::table('message')->insert([$param]);
        // postで送ら得た来たmsgを表示している。
        return view('sinup', ['msg' => $request->msg], ['mmm' => $request->mmm]);
    }

    // dataページから更新ボタンを押した際に更新するデータの表示 hrefで指定したIDを取る際の書き方 int $id
    public function update(Request $request, int $id)
    {
        $array = session()->get('pass');
        if (!empty($array)) {
            $item = DB::table('message')->where('id', ($id))->first();
            return view('update', [
                'item' => $item,
            ]);
        } else {
            return view('login', [
                'msg' => 'ログインのセッションが切れています',
                'link' => '',
            ]);
        }
        // dataページからIDを選択した時にidが同じレコードをDBから取得している。postで送る場合の書き方⇒where('id',($_POST['id']))submitのnameの名前がIdだからそこを変えたら、指定するものも変える。
    }

    //更新するデータの更新
    public function edit(Request $request)
    {
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'message' => $request->message,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id',$param);
        DB::table('message')->where('id', $request->id)->update($param);
        return redirect('/data');
    }

    // データを削除する画面の表示
    public function delete(Request $request, int $id)
    {
        $array = session()->get('pass');
        if (!empty($array)) {
            $item = DB::table('message')->where('id', ($id))->first();
            return view('delete', [
                'item' => $item,
            ]);
        } else {
            return view('login', [
                'msg' => 'ログインのセッションが切れています',
                'link' => '',
            ]);
        }
    }
    // データを削除する作業と作業後に戻る画面の表示
    public function remove(Request $request)
    {
        $param = [
            'id' => $request->id
        ];
        DB::table('message')->where('id', $request->id)->delete($param);
        return redirect('/data');
    }
    // 新規登録画面
    public function sin(Request $request)
    {
        return view('sin', [
            "msg" => '',
            "link" => '',
        ]);
    }
    // 新規登録の処理
    public function register(Request $request)
    {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        // $pass = $_POST['pass'];

        $data = [
            ['name' => $name, 'mail' => $mail, 'password' => $pass]
        ];
        //フォームに入力されたmailがすでに登録されていないかチェック
        // $sql = DB::table('users')->where('mail', $mail)->first();
        $count = DB::table('users')->where('mail', $mail)->get()->count();
        if ($count > 0) {
            return view('sin', [
                'msg' => '同じメールアドレスが存在します。登録できません。',
                'link' => '',
            ]);
        }
        $count = DB::table('users')->where('name', $name)->get()->count();
        if ($count > 0) {
            return view('sin', [
                'msg' => '同じユーザー名が存在します。登録できません。',
                'link' => '',
            ]);
        }
        //登録されていなければinsert 
        DB::table('users')->insert($data);
        return view('sin', [
            'msg' => '会員登録が完了しました',
            'link' => '1',
        ]);
    }
    // ログイン画面
    public function login(Request $request)
    {
        return view('login', [
            'msg' => '',
            'link' => '',
        ]);
    }
    // ログイン入力画面
    public function log(Request $request)
    {
        $name =  $request->input('name');
        // 上の取り方でも取れる。下の取り方でも行ける。
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        $count = DB::table('users')->where('name', $name)->get()->count();
        if ($count < 1) {
            return view('login', [
                'msg' => '違います。再度入力お願いします',
                'link' => '1',
            ]);
        }
        $count = DB::table('users')->where('mail', $mail)->get()->count();
        if ($count < 1) {
            return view('login', [
                'msg' => '再度入力お願いします。',
                'link' => '1',
            ]);
        }
        // 二つの条件がクリアー出来てたらパスワードを取れて来る。
        $user = DB::table('users')->where('name', $name)->where('mail', $mail)->first('password');
        // var_dump($user);
        // $password = password_verify($pass, $user->password);
        // var_dump($password);
        // パスワードの暗号化を解いている。
        if (password_verify($pass, $user->password)) {
            session()->put('pass', password_verify($pass, $user->password));
            return redirect('data');
        } else {
            return view('login', [
                'msg' => 'ログイン承認に失敗',
                'link' => '1',
            ]);
        }
    }
    // 管理者画面
    public function data(Request $request)
    {
        $array = session()->get('pass');
        if (!empty($array)) {
            $item = DB::select('select * from message');
            return view('data', [
                'item' => $item,
            ]);
        } else {
            return view('login', [
                'msg' => 'ログインのセッションが切れています',
                'link' => '',
            ]);
        }
    }
    // 検索画面
    public function search(Request $request)
    {
        $id = $request->id;
        $item = DB::table('message')->where('id', $id)->first();
        $name = $item->name;
        $id = $item->id;
        $message = $item->message;
        $time = $item->time;
        return view('search.register', [
            'name' => $name,
            'id' => $id,
            'message' => $message,
            'time' => $time,
        ]);
    }
    // 検索更新処理ページ
    public function research(Request $request)
    {
        $array = session()->get('pass');
        if (!empty($array)) {
            return view('research', [
                'msg' => '',
                'item' => '',
            ]);
        } else {
            return view('login', [
                'msg' => 'ログインのセッションが切れています',
                'link' => '',
            ]);
        }
    }
    public function research2(Request $request)
    {
        $id = $request->research;
        $name = $request->name;
        $time = $request->time;
        // $item = DB::table('message')->where('id', $id)->get();
        // $data = DB::table('message')->where('name', $name)->get();
        // $datatime = DB::table('message')->where('time', $time)->get();

        // どれか一つでも合致していたらデータを取って来る。
        $results = DB::table('message')->where('id', $id)
            ->orwhere('name', $name)
            ->orwhere('time', $time)
            ->get();
        var_dump($results);

        // if (!isset($item) or (!isset($data)) or (!isset($datatime))) こういった書き方もできる。どれか一つ条件が合えばok
        if (count($results) < 1) {
            return view('research', [
                'item' => '',
                'msg' => '該当するデータがありません。',
            ]);
        } else {
            return view('research', [
                'msg' => '',
                'item' => $results,
            ]);
        }
    }
}
