function cw_df_change_color(itemID,DefaultColor,Textdf){
	document.getElementById("cwlsm_settings[" + itemID + "]").value = DefaultColor;
	document.getElementById("cwlsm_settings[" + itemID + "]").style.background = DefaultColor;
	document.getElementById("cwlsm_settings[" + itemID + "]").style.color = Textdf;
}
