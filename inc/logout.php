<?php
session_unset();
header("Location: javascript://history.go(-1)");
exit();