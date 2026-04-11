$c=Get-Content .\resources\views\frontend\projects.blade.php; $c = $c[0..89] + $c[267..($c.Length-1)]; Set-Content .\resources\views\frontend\projects.blade.php $c
