/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#include "legacyapps/mi_aplic/mi_aplic_processor.h"
#ifdef ENABLE_MI_APLIC

#include "legacyapps/mi_aplic/mi_aplic_message.h"
#include "sys/simulation/simulation_controller.h"
#include "sys/node.h"
#include <iostream>


namespace mi_aplic
{
   MiAplicProcessor::
   MiAplicProcessor()
   {}
   // ----------------------------------------------------------------------
   MiAplicProcessor::
   ~MiAplicProcessor()
   {}
   // ----------------------------------------------------------------------
   void
   MiAplicProcessor::
   boot( void )
      throw()
   {}
   // ----------------------------------------------------------------------
   bool
   MiAplicProcessor::
   process_message( const shawn::ConstMessageHandle& mh ) 
      throw()
   {
      const MiAplicMessage* msg = 
          dynamic_cast<const MiAplicMessage*>( mh.get() );

      if( msg != NULL )
      { 
         if( owner() != msg->source() )
         { 
            neighbours_.insert( &msg->source() );
            INFO( logger(), "Mensaje recibido de '" 
                            << msg->source().label() 
                            << "'" );

         }
         return true;
      }

      return Processor::process_message( mh );
   }
   // ----------------------------------------------------------------------
   void
   MiAplicProcessor::
   work( void )
      throw()
   {
      // send message only in the first simulation round
      if ( simulation_round() == 0 )
      { 
         send( new MiAplicMessage );
      }
   }
}
#endif
