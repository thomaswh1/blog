
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>用户登录</title>
<link rel='stylesheet' id='buttons-css'  href='/home/css/buttons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='login-css'  href='/home/css/login.min.css' type='text/css' media='all' />
</head>

<body class="login login-action-lostpassword wp-core-ui  locale-zh-cn">
<div id="login">
	<h1><p class="message">用户登录</p></h1>
	<form name="lostpasswordform" id="lostpasswordform" action="{{url('/hdologin')}}" method="post">
		{{ csrf_field() }}

		 @if (count($errors) > 0)
            <div class="status">
                <ul>
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        <li>{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
		<!-- <p class="status">{{$errors}}</p> -->
		<p>
			<label for="user_name" >用户名<br />
			<input type="text" name="user_name" id="user_name" class="input" value="" size="20" /></label>
		</p>
		<p>
			<label for="user_pass" >密码<br />
			<input type="password" name="user_pass" id="user_pass" class="input" value="" size="20" /></label>
		</p>
		<p class="submit">
			<input type="submit" class="button button-primary button-large" value="登录" />
		</p>
	</form>

	<p id="nav">
	<a href="{{url('/homeuser/create')}}">注册</a>
	</p>

	<p id="backtoblog"><a href="{{url('/index')}}">&larr; 返回到博客首页</a></p>
		
</div>
</body>
</html>
	