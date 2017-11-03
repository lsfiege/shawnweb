/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004,2005 by  SwarmNet (www.swarmnet.de)             **
 **                         and SWARMS   (www.swarms.de)               **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the GNU General Public License, version 2.      **
 ************************************************************************/
#ifndef __SHAWN_TUBSAPPS_VIS_WRITER_H
#define __SHAWN_TUBSAPPS_VIS_WRITER_H
#include "../buildfiles/_apps_enable_cmake.h"
#ifdef ENABLE_VIS
#include "apps/vis/base/vis_needs_cairo.h"
#include <string>
#include <stdexcept>

namespace vis
{
   class Visualization;

   /** \brief Base class for visualization writer classes.
    * Base class for the visualization writer classes, which are used to save a frame 
    * or a series of frames to files of the corresponding output format.
	 *
	 * @sa vis::PNGWriter
	 * @sa vis::PDFWriter
	 */
   class Writer
   {
   public:
      ///@name Constructor/Destructor
      ///@{
      Writer();
      virtual ~Writer();
      ///@}


      ///@name Writing mechanism
      ///@{
	   /**
       * Called before write_frame to set needed parameters.
       */
      virtual void pre_write( const Visualization&,
                              const std::string& filename_base,
                              bool multi_frame )
         throw( std::runtime_error );
      /**
	    * Writes the frame.
       */
      virtual void write_frame( double )
         throw( std::runtime_error );
      /**
       * Called after writing the output file.
       */
      virtual void post_write( void )
         throw( std::runtime_error );
      ///@}

      ///@name Getter/Setter
      ///@{
	   /**
       * Returns the number of the next frame (for generating multiple frames).
       */
      virtual int next_frame_number( void )
         const throw();
      /**
       * Sets the draft level.
       */
      virtual void set_draft( int ) throw( std::runtime_error );
      /**
       * Gets the draft level.
       */
      virtual int draft_level( void ) const throw();
      ///@}

   protected:
	   /**
       * Drops the currently used cairo surface.
       */
      virtual void drop_surface( void ) throw();
      /**
       * Creates a new cairo surface. If there is already a surface, it is 
       * dropped automatically.
       */
	   virtual void make_surface( int, int ) throw() = 0;
      /**
       * Writes the current frame to the output file.
       */
	   virtual void write_frame_to_file( cairo_t* cr ) 
         throw( std::runtime_error ) = 0;

      
   private:
      /// Draft level. See vis::Context on effects of different draft levels.
      int draft_;

   protected:
	  /// Cairo surface.
      cairo_surface_t*     surface_; 
	  /// Surface width.
      int                  surface_width_; 
	  /// Surface height.
      int                  surface_height_; 
	  /// Number of the next frame generated by this writer object.
      int                  next_frame_;    
	  /// Defines, wether the writer generates a single (false) or multiple frames (true).
      bool                 multi_frame_;  
	  /// Base of the output filename.
      std::string          file_base_; 
	  /// Visualization base object.
      const Visualization* visualization_;
      bool                 last_freezed_;
   };

}
#endif
#endif