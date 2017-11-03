/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#ifndef __SHAWN_LEGACYAPPS_MI_APLIC_MI_APLIC_MESSAGE_H
#define __SHAWN_LEGACYAPPS_MI_APLIC_MI_APLIC_MESSAGE_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_MI_APLIC

#include "sys/message.h"

namespace mi_aplic
{

   class MiAplicMessage
       : public shawn::Message
   {
   public:
	   MiAplicMessage();
	   MiAplicMessage(int);
	   virtual ~MiAplicMessage();
   };

}

#endif
#endif
/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/mi_aplic/mi_aplic_message.h,v $
 * Version $Revision: 197 $
 * Date    $Date: 2008-04-29 12:40:51 -0300 (mar 29 de abr de 2008) $
 *-----------------------------------------------------------------------
 * $Log: mi_aplic_message.h,v $
 *-----------------------------------------------------------------------*/
