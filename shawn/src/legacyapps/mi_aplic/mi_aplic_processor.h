/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#ifndef __SHAWN_APPS_LEGACYAPPS_MI_APLIC_PROCESSOR_H
#define __SHAWN_APPS_LEGACYAPPS_MI_APLIC_PROCESSOR_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_MI_APLIC

#include "sys/processor.h"
#include <set>

namespace mi_aplic
{

   class MiAplicProcessor
       : public shawn::Processor
   {
   public:
      MiAplicProcessor();
      virtual ~MiAplicProcessor();

      virtual void boot( void ) throw();
      virtual bool process_message( const shawn::ConstMessageHandle& ) throw();
      virtual void work( void ) throw();

   protected:
      int last_time_of_receive_;
      std::set<const shawn::Node*> neighbours_;
   };


}

#endif
#endif
/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/mi_aplic/mi_aplic_processor.h,v $
 * Version $Revision: 419 $
 * Date    $Date: 2010-05-26 13:29:40 -0300 (mié 26 de may de 2010) $
 *-----------------------------------------------------------------------
 * $Log: mi_aplic_processor.h,v $
 *-----------------------------------------------------------------------*/
