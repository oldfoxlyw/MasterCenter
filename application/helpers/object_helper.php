<?php
function merge_object($source, $dest, $overWrite = false)
{
	$sourceName = get_class ( $source );
	foreach ( $source as $key => $aProp )
	{
		if (! $overWrite && isset ( $dest->$key ))
		{
			$propName = $sourceName . "_" . $key;
			$dest->$propName = $aProp;
		}
		else
		{
			$dest->$key = $aProp;
		}
	}
	return $dest;
}