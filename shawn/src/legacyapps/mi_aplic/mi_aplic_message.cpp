/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#include "legacyapps/mi_aplic/mi_aplic_message.h"
#ifdef ENABLE_MI_APLIC

namespace mi_aplic
{

	// ----------------------------------------------------------------------
	MiAplicMessage::
		MiAplicMessage()
	{}
   
	// ----------------------------------------------------------------------
	MiAplicMessage::
		MiAplicMessage(int size)
	{
		setSize(size);
	}

	// ----------------------------------------------------------------------
	MiAplicMessage::
		~MiAplicMessage()
	{}

}
#endif

/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/mi_aplic/mi_aplic_message.cpp,v $
 * Version $Revision: 126 $
 * Date    $Date: 2008-02-21 13:33:02 -0200 (jue 21 de feb de 2008) $
 *-----------------------------------------------------------------------
 * $Log: mi_aplic_message.cpp,v $
 *-----------------------------------------------------------------------*/
